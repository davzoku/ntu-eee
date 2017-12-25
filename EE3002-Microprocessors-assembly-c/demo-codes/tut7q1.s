			AREA FIBONACCI, CODE, READONLY	
			;Registers used;
			;r0 = value of n
			;r1 = starting address of table
			;r2 = temp for Fibonacci F(n-2)
			;r3	= temp for Fibonacci F(n-1)
			;r5 = temp register

TABLE_BASE	EQU 0x40000000
			ENTRY
			MOV r0, #0					;n=0
			MOV r1, #TABLE_BASE			;base of table
		  	MOV r2, #0					;value of F(0)=0
			STR r2, [r1, r0]			;store F(0)

			ADD r0, r0, #1				;n=n+1=1
			MOV r3, #1					;value of F(1)=1
			STR r3, [r1, r0, LSL #2]	;store F(1)

			ADD r0, r0, #1				;n=n+1
loop		CMP r0, #21					;n<21, proceed
			BGE stop					;else finish
			MOV r5, r3					;temp store F(n-1)
			ADD r3, r2, r3				;F(n)=F(n-2)+F(n-1)
			MOV r2, r5					;update F(n-1)
			STR r3, [r1, r0, LSL #2]	;store F(n)
			ADD r0, r0, #1				;n=n+1
			B   loop

stop		B   stop
			END