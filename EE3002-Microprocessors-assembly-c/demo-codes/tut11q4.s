		AREA division, CODE, READONLY
		ENTRY
		;IN:	r0 (value), r1 (divisor)
		;OUT:	r2 (remainder), r3 (quotient)
setThumbState
		LDR   r4, =thumbDivide+1	;set LSB=1 for THUMB state
		BX    r4				  	;branch and switch to thumb
		CODE16
thumbDivide
		MOV   r0, #10
		MOV   r1, #3
		MOV   r3, #0
thumbLoop
		ADD   r3, #1  		;ADD has to be done first as both
		SUB   r0, r1 		;ADD and SUB will set the flag and
		BGE   thumbLoop		;thumbLoop depends on SUB r0, r1
		SUB   r3, #1
		ADD   r0, r1
		MOV   r2, r0
stop	B stop
		END
