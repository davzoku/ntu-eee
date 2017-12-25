;input r0 points to src string "stressed"
;output r1 points to dst string
	PRESERVE8
	AREA reverseStr, CODE, READONLY
	EXPORT revStr
	ENTRY
revStr
	STMFD sp!, {r4-r5, lr}
	
	;get length of src
	MOV r4, #0				;loop counter
loop1
	LDRB r5, [r0], #1		;get character
	CMP  r5, #0				;end of string?
	BEQ  rev
	ADD  r4, r4, #1			;increment counter
	B    loop1
rev							;start reversing
	SUB  r0, r0, #1			;adjust src pointer
loop2
	LDRB r5, [r0, #-1]!		;get src character
	STRB r5, [r1], #1 		;store to dst
	SUBS r4, r4, #1
	BGT  loop2

	MOV  r5, #0
	STRB r5, [r1]			;terminate dst string
	LDMFD sp!, {r4-r5, pc}	
	END


		