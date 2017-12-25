#include <stdio.h>         
#include <LPC21xx.H>      	/* LPC21xx definitions                        */
extern void Init_serial(void);
extern void appendStr(const char *s1, const char *s2, char *s3);

/* main program */
int main (void)  {    
  const char *s1 = "Hello";
  const char *s2 = "World";
  char s3[11];

  Init_serial();  			/* initialize the serial interface            */

  appendStr(s1,s2,s3);
  printf ("Appending %s with %s produces %s\n", s1, s2, s3);

  while (1) {            	/* An embedded program does not stop and      */
    ;  /* ... */         	/* never returns. We use an endless loop.     */
  }                     	/* Replace the dots (...) with your own code. */
}
