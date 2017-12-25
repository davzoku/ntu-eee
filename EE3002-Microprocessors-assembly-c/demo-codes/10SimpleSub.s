			AREA simpleSub, CODE, READONLY
			ENTRY
			MOV r0, #1		;some instruction
			BL  simple		;call subroutine SIMPLE
			MOV r2, #2		;return from subroutine	SIMPLE

stop		B stop			;stop

simple		ADD r3, r2, #1	;do something
			MOV pc, lr			;return to calling program
			;BX lr

			END