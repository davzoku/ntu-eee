ram_base EQU 0x40000000
		AREA fillMemory, CODE, READONLY
		ENTRY
start
		LDR		r0, =tstarea		;start address of memory
		LDR		r1,	=32				;length 
		LDR		r2,	=0xA0B0C0D0		;value
		LDR		sp, =ram_base + 0x1000
		STMFD	sp!, {r0-r2}		
		BL		fillmem		
		LDMFD	sp!, {r0-r2}		
stop	B		stop
fillmem
		STMFD	sp!, {r4-r7, lr}
		LDR		r4, [sp, #20]
		LDR		r5, [sp, #24]
		LDR		r6, [sp, #28]
		MOV		r7, #0
loop	CMP		r7, r5
		BHS		endloop
		STR		r6, [r4, r7, LSL #2]
		ADD		r7, r7, #1
		B		loop
endloop		
		LDMFD	sp!, {r4-r7, pc}
		AREA	test, DATA, READWRITE
tstarea	SPACE	256					;reserve 256 bytes 
		END
