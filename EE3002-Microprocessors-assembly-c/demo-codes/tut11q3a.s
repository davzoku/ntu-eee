		AREA tut11q3a, CODE, READONLY
		ENTRY
		MOV  r2, #1
		MOV  r3, #2
		ADDS r0, r3, r2, LSL #2	;r2, r3 unchange after exec
		;switch to thumb
		LDR  r4, =inThumb+1
		BX   r4
inThumb
		CODE16
		MOV  r1, r2		;copy r2 to r1
		LSL  r1, #2
		ADD  r0, r3, r1	
stop	B    stop
		END