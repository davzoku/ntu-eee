#include <stdio.h>
#include <LPC21xx.H>          	/* LPC21xx definitions                       */
extern void Init_serial(void);

__inline int myMax(int x, int y, int z)
{
	int tempMax = x;		//let x be tempMax
	__asm
	{
		CMP   tempMax, y
		MOVLT tempMax, y	//swap if tempMax is smaller
		CMP   tempMax, z
		MOVLT tempMax, z	//swap if tempMax is smaller			
	}
	return tempMax;
}

int main (void)  {             
  int x=9, y=4, z=12, maxNum;
  Init_serial();  				/* initialize the serial interface           */

  maxNum = myMax(x, y, z);		/*call inline asm function					 */
  printf ("The maximum of %d, %d and %d is %d\n", x, y, z, maxNum);

  while (1) {                 	/* An embedded program does not stop and     */
    ;  /* ... */               	/* never returns. We use an endless loop.    */
  }                           	/* Replace the dots (...) with your own code.*/
}
