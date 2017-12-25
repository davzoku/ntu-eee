#include <stdio.h>                /* prototype declarations for I/O functions */
#include <LPC21xx.H>              /* LPC21xx definitions                      */
extern void Init_serial(void);

__asm void myStrcpy(const char *scr, char *dst)
{
loop
	LDRB r2, [r0], #1
	STRB r2, [r1], #1
	CMP  r2, #0
	BNE  loop
	BX   lr

}
/****************/
/* main program */
/****************/
int main (void)  {           	/*execution starts here                    */
	const char *a="hello world";/*array of 12 characters = string		   */
	char b[12];
  	Init_serial();  			/*initialize the serial interface          */
	myStrcpy(a, b);
	printf ("original string: %s\n", a);
	printf ("copied string: %s\n", b);

  while (1) {                	/*An embedded program does not stop and   	*/
    ;  /* ... */              	/*never returns. We use an endless loop. 	*/
  }                          	/*Replace the dots (...) with your own code.*/
}
