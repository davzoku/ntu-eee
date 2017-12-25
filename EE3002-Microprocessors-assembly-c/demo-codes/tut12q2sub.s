;input r0, r1
;output r2
	AREA tut2q2, CODE, READONLY
	ENTRY
	EXPORT appendStr
appendStr	
	STMFD sp!, {r4-r7, lr}
	MOV   r4, r0		;temp pointer for s1
	MOV   r5, r1		;temp pointer for s2
	MOV   r6, r2		;temp pointer for s3
loop1
	LDRB  r7, [r4], #1	;load char from s1
	STRB  r7, [r6], #1	;store char to s3
	CMP   r7, #0
	BNE   loop1
	SUB   r6, r6, #1	;remove '0' from s3
loop2								
	LDRB  r7, [r5], #1	;load char from s2
	STRB  r7, [r6], #1	;store char to s3
	CMP   r7, #0		
	BNE   loop2
	LDMFD sp!, {r4-r7, pc}
	END