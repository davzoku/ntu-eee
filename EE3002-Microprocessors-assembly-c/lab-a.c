/******************************************************************************/
/* newBlinky.c: LED Flasher                                                      */
/******************************************************************************/
/* This file is part of the uVision/ARM development tools.                    */
/* Copyright (c) 2010 Keil - An ARM Company. All rights reserved.             */
/* This software may only be used under the terms of a valid, current,        */
/* end user licence from KEIL for a compatible version of KEIL software       */
/* development tools. Nothing else gives you the right to use this software.  */
/******************************************************************************/

#include <stdio.h>
#include "stm32f10x.h"                  /* STM32F10x.h definitions            */
#include "GLCD.h"
#include "math.h"
#define __FI        1                   /* Font index 16x24                   */

#define LED_NUM     8                   /* Number of user LEDs                */
const unsigned long led_mask[] = { 1UL <<  8, 1UL <<  9, 1UL << 10, 1UL << 11,
                                   1UL << 12, 1UL << 13, 1UL << 14, 1UL << 15};

               char text[40];

/* Import external function from Serial.c file                                */
extern void SER_Init (void);

/* Import external variables from IRQ.c file                                  */
extern unsigned short AD_last;
extern unsigned char  AD_done;
extern unsigned char  clock_1s;


/* variable to trace in LogicAnalyzer (should not read to often)              */
volatile unsigned short AD_dbg, AD_print;          

/*----------------------------------------------------------------------------
  note: 
  set __USE_LCD in "options for target - C/C++ - Define" to enable Output on LCD
  set __USE_IRQ in "options for target - C/C++ - Define" to enable ADC in IRQ mode
                                                        default is ADC in DMA mode
 *----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Function that initializes ADC
 *----------------------------------------------------------------------------*/
void ADC_init (void) {

  RCC->APB2ENR |= ( 1UL <<  4);         /* enable periperal clock for GPIOC   */
  GPIOC->CRL &= ~0x000F0000;            /* Configure PC4 as ADC.14 input      */

#ifndef __USE_IRQ
  /* DMA1 Channel1 configuration ---------------------------------------------*/
  RCC->AHBENR |= ( 1UL <<  0);          /* enable periperal clock for DMA     */

  DMA1_Channel1->CMAR  = (u32)&AD_last;    /* set channel1 memory address     */
  DMA1_Channel1->CPAR  = (u32)&(ADC1->DR); /* set channel1 peripheral address */
  DMA1_Channel1->CNDTR = 1;             /* transmit 1 word                    */
  DMA1_Channel1->CCR   = 0x00002522;    /* configure DMA channel              */
  NVIC_EnableIRQ(DMA1_Channel1_IRQn);   /* enable DMA1 Channel1 Interrupt     */
  DMA1_Channel1->CCR  |= (1 << 0);      /* DMA Channel 1 enable               */
#endif

  /* Setup and initialize ADC converter                                       */
  RCC->APB2ENR |= ( 1UL <<  9);         /* enable periperal clock for ADC1    */

  ADC1->SQR1    =  0;                   /* Regular channel 1 conversion       */
  ADC1->SQR2    =  0;                   /* Clear register                     */
  ADC1->SQR3    = (14UL <<  0);         /* SQ1 = channel 14                   */
  ADC1->SMPR1   = ( 5UL << 12);         /* sample time channel 14 55,5 cycles */
  ADC1->CR1     = ( 1UL <<  8);         /* Scan mode on                       */
  ADC1->CR2     = ( 7UL << 17)|         /* select SWSTART                     */
                  ( 1UL << 20) ;        /* enable ext. Trigger                */

#ifndef __USE_IRQ
  ADC1->CR2    |= ( 1UL <<  8);         /* DMA mode enable                    */
#else
  ADC1->CR1    |= ( 1UL <<  5);         /* enable for EOC Interrupt           */
  NVIC_EnableIRQ(ADC1_2_IRQn);          /* enable ADC Interrupt               */
#endif

  ADC1->CR2    |= ( 1UL <<  0);         /* ADC enable                         */

  ADC1->CR2    |=  1 <<  3;             /* Initialize calibration registers   */
  while (ADC1->CR2 & (1 << 3));         /* Wait for initialization to finish  */
  ADC1->CR2    |=  1 <<  2;             /* Start calibration                  */
  while (ADC1->CR2 & (1 << 2));         /* Wait for calibration to finish     */
}


/*----------------------------------------------------------------------------
  Function that initializes User Buttons
 *----------------------------------------------------------------------------*/
void BUT_init(void) {
  RCC->APB2ENR |= (1UL << 8);           /* Enable GPIOG clock                 */

  GPIOG->CRH   &= ~0x0000000F;          /* Configure the GPIO for Button      */
  GPIOG->CRH   |=  0x00000004;
}

/*----------------------------------------------------------------------------
  Function that initializes Joystick
 *----------------------------------------------------------------------------*/
void JOY_init(void) {
  RCC->APB2ENR |= (1UL << 8);           /* Enable GPIOG clock                 */
  RCC->APB2ENR |= (1UL << 5);           /* Enable GPIOD clock                 */

  GPIOG->CRL   &= ~0xF0000000;          /* Configure the GPIO for Joystick    */
  GPIOG->CRL   |=  0x40000000;
  GPIOG->CRH   &= ~0xFFF00000;
  GPIOG->CRH   |=  0x44400000;

  GPIOD->CRL   &= ~0x0000F000;          /* Configure the GPIO for Joystick    */
  GPIOD->CRL   |=  0x00004000;
}

/*----------------------------------------------------------------------------
  Function that initializes LEDs
 *----------------------------------------------------------------------------*/
void LED_init(void) {
  RCC->APB2ENR |= (1UL << 3);           /* Enable GPIOB clock                 */

  GPIOB->ODR   &= ~0x0000FF00;          /* switch off LEDs                    */
  GPIOB->CRH   &= ~0xFFFFFFFF;          /* Configure the GPIO for LEDs        */
  GPIOB->CRH   |=  0x33333333;
}

/*----------------------------------------------------------------------------
  Function that turns on requested LED
 *----------------------------------------------------------------------------*/
void LED_On (unsigned int num) {

  GPIOB->BSRR = led_mask[num];
}

/*----------------------------------------------------------------------------
  Function that turns off requested LED
 *----------------------------------------------------------------------------*/
void LED_Off (unsigned int num) {

  GPIOB->BRR = led_mask[num];
}

/*----------------------------------------------------------------------------
  Function that outputs value to LEDs
 *----------------------------------------------------------------------------*/
void LED_Out(unsigned int value) {
  int i;

  for (i = 0; i < LED_NUM; i++) {
    if (value & (1<<i)) {
      LED_On (i);
    } else {
      LED_Off(i);
    }
  }
}

/*----------------------------------------------------------------------------
  Main Program
 *----------------------------------------------------------------------------*/
int main (void) {
  int ad_val   =  0, ad_avg   = 0, ad_val_  = 0xFFFF;
  int joy      =  0, joy_     = -1;
  int but      =  0, but_     = -1;
	int pattern = 0, i;
	
  int status = 0, direction = 1;			/* variables for move/stop and up/down*/

	extern unsigned int time_count;				/* time_count imported from IRQ.c     */
  SysTick_Config(SystemCoreClock/100);  /* Generate interrupt each 10 ms      */

  LED_init();                           /* LED Initialization                 */
  BUT_init();                           /* User Button Initialization         */
  JOY_init();                           /* Joystick Initialization            */
  SER_Init();                           /* UART Initialization                */
  ADC_init();                           /* ADC Initialization                 */

  GLCD_Init();                          /* Initialize graphical LCD display   */

  GLCD_Clear(White);                    /* Clear graphical LCD display        */
  
  GLCD_SetBackColor(Blue);
  GLCD_SetTextColor(White);
  GLCD_DisplayString(0, 0, __FI, "     Nicole Yee    ");
  GLCD_DisplayString(1, 0, __FI, "    Muhd Sufian   ");
  GLCD_DisplayString(2, 0, __FI, "   LED LIGHT SHOW!   ");
  GLCD_SetBackColor(White);
  GLCD_SetTextColor(Blue);
	GLCD_DisplayString(4, 0, __FI, "time_count:            ");
  GLCD_DisplayString(5, 0, __FI, "Pattern:   0         ");
  GLCD_DisplayString(6, 0, __FI, "Button  :            ");
  GLCD_DisplayString(8, 0, __FI, "Joystick:            ");
	
  GLCD_SetTextColor(Red);
	GLCD_DisplayString(6, 15, __FI, "Move");
  GLCD_DisplayString(8, 15, __FI, "DOWN");
	
  while (1) {                           /* Loop forever                       */
    /* Collect all input signals                                              */

    /* AD converter input                                                     */
    if (AD_done) {                      /* If conversion has finished         */
      AD_done = 0;
                                        /* Ad value is read via IRQ or DMA     */
      ad_avg += AD_last << 8;             /* Add AD value to averaging          */
      ad_avg ++;
      if ((ad_avg & 0xFF) == 0x10) {
        ad_val = ad_avg >> 12;
        ad_avg = 0;
      }
    }

    /* Joystick input                                                         */
    joy = 0;
    if (GPIOG->IDR & (1 << 14)) joy |= (1 << 0);  /* Joystick left            */
    if (GPIOG->IDR & (1 << 13)) joy |= (1 << 1);  /* Joystick right           */
    if (GPIOG->IDR & (1 << 15)) joy |= (1 << 2);  /* Joystick up              */
    if (GPIOD->IDR & (1 <<  3)) joy |= (1 << 3);  /* Joystick down            */
    if (GPIOG->IDR & (1 <<  7)) joy |= (1 << 4);  /* Joystick select          */
    joy ^= 0x1F;

    /* Button inputs                                                          */
    but = 0;
    if (GPIOG->IDR & (1 <<  8)) but |= (1 << 0);  /* Button User (User)       */
    but ^= 0x01;

		
    /* Show all signals                                                       */
    if (ad_val ^ ad_val_) {             /* Show AD value bargraph             */

			sprintf(text, "%08X", time_count);
      GLCD_SetTextColor(Red);
      GLCD_DisplayString(4,  11, __FI,  (unsigned char *)text);
			GLCD_Bargraph (144, 3*24, 176, 20, (ad_val>>2));

      AD_print = ad_val;                /* Get unscaled value for printout    */
      AD_dbg   = ad_val;

      ad_val_ = ad_val;
    }
		
    /* Button inputs                                                          */
    but = 0;
    if (GPIOG->IDR & (1 <<  8)) but |= (1 << 0);  /* Button User (User)       */
    but ^= 0x01;

    if (but ^ but_) {                        /* Show buttons status           */

      if (but & (1 << 0)) {
				RCC->APB2ENR ^= (1UL << 3); 
				if (status==0)
				{
					status = 1;
					GLCD_DisplayString(6, 15, __FI, "Stop");
				}
				else
				{
					status = 0;
				  GLCD_DisplayString(6, 15, __FI, "Move");
				}
        GLCD_SetTextColor(Red);
        GLCD_DisplayString(6,  9, __FI, "User");
      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayString(6,  9, __FI, "User");
      }
      but_ = but;
    }
		
    /* Joystick input                                                          */
    if (joy ^ joy_) {                    /* Show joystick status               */
      if (joy & (1 << 0)) {              /* check  "Left" Key */
        GLCD_SetTextColor(Red);
        GLCD_DisplayChar(8,  9, __FI, 0x80+ 9);
				pattern --;
				if (pattern < 0) pattern = 0;
				GLCD_DisplayChar(5,  11, __FI, 48+pattern);
	      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayChar(8,  9, __FI, 0x80+ 8);
      }
      if (joy & (1 << 1)) {           /* check "Right" Key */
        GLCD_SetTextColor(Red);
        GLCD_DisplayChar(8, 11, __FI, 0x80+11);
				pattern ++;
				if (pattern > 4) pattern = 4;
				GLCD_DisplayChar(5,  11, __FI, 48+pattern);
      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayChar(8, 11, __FI, 0x80+10);
      }
      if (joy & (1 << 2)) {             /* check "Up" Key */
				
				GLCD_DisplayString(8, 15, __FI, " UP ");
				direction = 0;
				
        GLCD_SetTextColor(Red);
        GLCD_DisplayChar(7, 10, __FI, 0x80+ 5);
      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayChar(7, 10, __FI, 0x80+ 4);
      }
      if (joy & (1 << 3)) {				/* check "Down" Key */
				
				GLCD_DisplayString(8, 15, __FI, "DOWN");
				direction = 1;
				
        GLCD_SetTextColor(Red);
        GLCD_DisplayChar(9, 10, __FI, 0x80+ 7);
      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayChar(9, 10, __FI, 0x80+ 6);
      }
      if (joy & (1 << 4)) {            /* check "Sel" Key */
        GLCD_SetTextColor(Red);
        GLCD_DisplayChar(8, 10, __FI, 0x80+ 1);
      } else {
        GLCD_SetTextColor(LightGrey);
        GLCD_DisplayChar(8, 10, __FI, 0x80+ 0);
      }

      joy_ = joy;
    }
 
		// Display LED patterns according to the pattern
			
switch (pattern){
	case 0: {		
		if (direction == 1) {
			i = 1 << (time_count %8);
			LED_Out(i);			/* Turn LED[i] on */
		}
		else
		{
			i=128 >> (time_count%8);
			LED_Out(i);
		}
	}		
	break;
	case 1: {
	  if ((time_count%2)==1) {
			LED_Out(0xFF);
	} else
	{ 
		LED_Out(0x00);
	}
}
  break; 
  case 2: {
	  if ((time_count%2)==1) {
			LED_Out(0x55);
	} else
	{ 
		LED_Out(0xAA);
	}				
  }
	break;		   
	case 3: {
		int c = time_count%16;
		if(c<8)
		{
       i=1<<(time_count%8);			
		LED_Out(i);			/* Turn LED[i] on */		
		}
		else 
		{ i=128 >> (time_count%8);
			LED_Out(i);
		}
	}
	break;	 
  case 4: {
		switch(time_count%8){
			case 0: LED_Out(0x81);
				break;
			case 1: LED_Out(0x42);
				break;
			case 2: LED_Out(0x24);
				break;
			case 3: LED_Out(0x18);
				break;
			case 4: LED_Out(0x24);
				break;
			case 5: LED_Out(0x42);
				break;
			case 6: LED_Out(0x81);
				break;

  }  
}	
	case 5: { 
		i=1<<(time_count%8)/128>>(time_count%8);                              
		LED_Out(i);
				break;
			
  }  
	
}
}
}
