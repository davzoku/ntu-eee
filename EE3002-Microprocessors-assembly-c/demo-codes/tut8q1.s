	AREA tut8q1, CODE
	ENTRY
	LDR r4, =0x40000000
	MOV r5, #5
	MOV r6, #6
	MOV r7, #7

	STM r4, {r4-r6}
	LDM r4, {r4, r7}
	LDM r4!, {r4, r5}
	STMIA  r5!, {r5, r4, r9}
	LDMDA  r2, {}
	STMDB  r15!, {r0-r3, r4, lr}			
stop B stop
	END
