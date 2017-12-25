		AREA SequentialSearch, CODE, READONLY
		ENTRY
		MOV    r0, #0			;found = 0 -> not found
		MOV    r1, #5			;n = 5 -> number of items in list				
		LDR    r2, =list		;load starting address of list
		LDR    r3, =0x9ABCDEF1	;load key
		MOV    r4, #0			;index = 0
loop	
		CMP    r4, r1			;index < n
		BGE    done
		LDR    r5, [r2, r4,	LSL #2]	;load table item at index
		CMP    r5, r3				;any match with the key
		BEQ    found				;found, r0 points to matched item
		ADD    r4, r4, #1			;inc index
		B      loop
found   ADD    r0, r2, r4, LSL #2	;r0 = address of matched item	
done	B      done

		AREA DATA1,	DATA,	READWRITE						
list	DCD    0x12345678		;1st item
		DCD    0x56789ABC		;2nd item
		DCD    0x9ABCDEF1		;3rd item
		DCD    0xDEF01234		;4th item
		DCD    0x00001234		;5th item
		END
