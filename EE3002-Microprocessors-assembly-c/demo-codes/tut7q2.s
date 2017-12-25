		AREA SearchTable, CODE, READONLY
		ENTRY
main		
		LDR    r0, =list		;pointer, initially load starting address of list
		LDR	   r5, =list		;keep a copy of list addr since we need to update later
		LDR    r1, =0x9ABCDEF0	;load search item
		LDR    r2, [r0]			;load length of list
		LDR    r3, [r0], #4		;init counter and increment pointer
		LDR    r4, [r0]			;load 1st item
loop		
		CMP    r1, r4			;any match?
		BEQ    stop				;found, r0 points to matched item
		SUBS   r3, r3, #1		;no, decrement counter and update the flags
		LDRNE  r4, [r0, #4]!	;update pointer to get next item, if counter<>0 
		BNE    loop  			;and loop
add_new		
		ADD    r2, r2, #1		;no match, so add search item to end of list
		STR    r2, [r5]			;update the length of list
		STR    r1, [r0, #4]!	;store new item
stop	B      stop
		AREA DATA1,	DATA,	READWRITE						
list	DCD	   4				;number of items in list
		DCD    0x12345678		;1st item
		DCD    0x56789ABC		;2nd item
		DCD    0x9ABCDEF1		;3rd item
		DCD    0xDEF01234		;4th item
store	SPACE  20				;reserve 20 bytes of storage for list
		END
