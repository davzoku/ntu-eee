;int f(int i) {return g(i, 2*i, 3*i, 4*i, 5*i);}
;i is in r0
	PRESERVE8
	EXPORT f
	IMPORT g
	AREA funcf, CODE, READONLY
	ENTRY
f	
	STMFD sp!, {r4, lr}
	ADD   r1, r0, r0	;2*i
	ADD	  r2, r1, r0	;3*i
	ADD   r3, r1, r1	;4*i
	ADD   r4, r1, r2	;5*i
	STMFD sp!, {r4}		;5th parameter is in stack
	BL    g				;call function g
	LDMFD sp!, {r4}		;remove 5th parameter from stack
	LDMFD sp!, {r4, pc}
	END

	
	
				  