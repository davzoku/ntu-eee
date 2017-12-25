#include <stdio.h>
#include <LPC21xx.H>          	/* LPC21xx definitions                       */
extern void Init_serial(void);

__asm int myMax(int x, int y, int z)
{
	MOV   r3, r0	;make first number be max
	CMP   r3, r1
	MOVLT r3, r1	;swap if max is smaller
	CMP   r3, r2
	MOVLT r3, r2	;swap if max is smaller
	MOV   r0, r3	;return max in r0
	BX    lr		;return	
}

int main (void)  {             
  int x=9, y=4, z=12, maxNum;
  Init_serial();  				/* initialize the serial interface           */

  maxNum = myMax(x, y, z);		/*call embedded asm function					 */
  printf ("The maximum of %d, %d and %d is %d\n", x, y, z, maxNum);

  while (1) {                 	/* An embedded program does not stop and     */
    ;  /* ... */               	/* never returns. We use an endless loop.    */
  }                           	/* Replace the dots (...) with your own code.*/
}
