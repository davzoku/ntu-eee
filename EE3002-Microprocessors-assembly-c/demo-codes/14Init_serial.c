
#include <stdio.h>                /* prototype declarations for I/O functions */
#include <LPC21xx.H>              /* LPC21xx definitions                      */

/****************/
/* Init_serial */
/****************/
void Init_serial (void)  {

  /* initialize the serial interface   */
  PINSEL0 = 0x00000005;           /* Enable RxD1 and TxD1 of UART0, Table 12.2*/
  U0LCR = 0x83;                   /* 8 bits, no Parity, 1 Stop bit            */
  U0DLL = 97;                     /* 9600 Baud Rate @ 15MHz VPB Clock         */
  U0LCR = 0x03;					  /* DLAB=0                                   */

}
