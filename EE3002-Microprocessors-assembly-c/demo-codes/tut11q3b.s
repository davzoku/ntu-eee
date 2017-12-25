		AREA tut11q3b, CODE, READONLY
		ENTRY
		LDR  r4, =testData
		MOV  r5, #1
		LDR  r1, [r4, r5, LSL #2]	;r4, r5 unchange after exec
		;switch to thumb
		LDR  r0, =inThumb+1
		BX   r0
inThumb
		CODE16
		MOV  r6, r5					;copy r5 to r6
		LSL  r6, #2
		LDR  r1, [r4, r6]	
stop	B    stop
testData
		DCD 1, 2, 3, 4, 5, 6, 7, 8
		END
