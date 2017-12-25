#include <stdio.h>                /* prototype declarations for I/O functions */
#include <LPC21xx.H>              /* LPC21xx definitions                      */
extern void Init_serial(void);

__inline int myadd(int x, int y)
{
	int result;

	__asm{ADD result, x, y};

	return result;
}

/****************/
/* main program */
/****************/
int main (void)  {                /* execution starts here                    */

  int add2numbers, n1=3,n2=5;

  Init_serial();  				  /* initialize the serial interface          */

  add2numbers = myadd(n1, n2);

  printf ("%d + %d = %d", n1, n2, add2numbers);

  while (1) {                          /* An embedded program does not stop and       */
    ;  /* ... */                       /* never returns. We use an endless loop.      */
  }                                    /* Replace the dots (...) with your own code.  */
}
