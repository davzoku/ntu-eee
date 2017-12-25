/******************************************************************************/
/* myFirstC.C: Hello World Example                                               */
/******************************************************************************/
/* This file is part of the uVision/ARM development tools.                    */
/* Copyright (c) 2005-2006 Keil Software. All rights reserved.                */
/* This software may only be used under the terms of a valid, current,        */
/* end user licence from KEIL for a compatible version of KEIL software       */
/* development tools. Nothing else gives you the right to use this software.  */
/******************************************************************************/

#include <stdio.h>                /* prototype declarations for I/O functions */
#include <LPC21xx.H>              /* LPC21xx definitions                      */
extern void Init_serial(void);

/****************/
/* main program */
/****************/
int main (void)  {                /* execution starts here                    */

  Init_serial();  				  /* initialize the serial interface          */

  /* the 'printf' function call               */
  printf ("Hello Everyone, Welcome  to the world!\n");

  while (1) {                          /* An embedded program does not stop and       */
    ;  /* ... */                       /* never returns. We use an endless loop.      */
  }                                    /* Replace the dots (...) with your own code.  */
}
