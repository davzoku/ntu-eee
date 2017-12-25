#include <stdio.h>             	/* prototype declarations for I/O functions  */ 
#include <LPC21xx.H>          	/* LPC21xx definitions                       */
extern void Init_serial(void);
extern int f(int i);

/* main program */
int main (void)  {           	/* execution starts here                     */
	int i;
  	Init_serial();  			/* initialize the serial interface           */

	i = 2;						/*valueof i goes into r0                     */

	/*call f(i) and then print result                                        */
	printf ("for i = %d, i+2i+3i+4i+5i = %d\n",i, f(i)); 	/*call arm subroutine            */

  	while (1) {              	/* An embedded program does not stop and     */
    ;  /* ... */              	/* never returns. We use an endless loop.    */
  	}                         	/* Replace the dots (...) with your own code.*/
}
