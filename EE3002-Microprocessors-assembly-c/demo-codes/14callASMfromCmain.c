#include <stdio.h>             	/* prototype declarations for I/O functions  */ 
#include <LPC21xx.H>          	/* LPC21xx definitions                       */
extern void Init_serial(void);
extern void revStr(const char *s, char *d);

/* main program */
int main (void)  {           	/* execution starts here                     */
  	const char *src = "stressed";
  	char dst[9];

  	Init_serial();  			/* initialize the serial interface           */

	revStr (src, dst);
  	printf ("%s when reads in reverse is %s\n", src, dst);

  	while (1) {              	/* An embedded program does not stop and      */
    ;  /* ... */              	/* never returns. We use an endless loop.     */
  	}                         	/* Replace the dots (...) with your own code. */
}
