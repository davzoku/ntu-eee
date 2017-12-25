;input r9 = 0x12345678
;output r2 = 0x1E6A2C48
RAM_BASE	EQU 0x40000000
T_bit 		EQU	0x20 		;Thumb bit of CPSR/SPSR, that is, bit 5
Mode_SVC	EQU 0x13		;bits for supervisor mode
Mode_USR	EQU 0x10		;bits for user mode
I_bit		EQU 0x80		;I bit = 1 disable IRQ
F_bit		EQU 0x40		;F bit = 1 disable FIQ

		AREA SWIexample, CODE, READONLY
		ENTRY
		;init exception vector table
		B	reset_handler
		B	undefined_instruction_handler
		B	SWI_handler
		B	prefetch_abort_handler
		B	data_abort_handler
		SPACE 4
		B	IRQ_handler

FIQ_handler	
		;handle FIQ here

undefined_instruction_handler	B undefined_instruction_handler
prefetch_abort_handler			B prefetch_abort_handler
data_abort_handler				B data_abort_handler
IRQ_handler						B IRQ_handler

		AREA resetHandler, CODE, READONLY
reset_handler
		;handle reset exception here
		LDR sp, =RAM_BASE+0x100		;init sp in svc mode
		MSR cpsr_c, #Mode_USR		;enter user mode and enable I and F
		LDR	sp,	=RAM_BASE + 0x200	;init sp in user mode
		LDR r9, =0x12345678
		SWI	0x1234					;trigger software interrupt 0x1234
		;return from SWI
stop	B stop

		AREA swiHandler, CODE, READONLY
SWI_handler
		;handle software interrupt here 
		STMFD   sp!, {r4-r5, lr} 		;Store registers
		;disable I and F
		MSR		cpsr_c, #Mode_SVC:OR:I_bit:OR:F_bit
		MRS		r4, spsr 			;Move SPSR into general purpose register
		TST    	r4, #T_bit 			;Occurred in Thumb state? 
		LDRNEH 	r4,[lr,#-2] 		;Yes: load halfword and... 
		BICNE  	r4,r4,#0xFF00 		; ...extract SWI number 
		LDREQ  	r4,[lr,#-4] 		;No: load word and... 
		BICEQ  	r4,r4,#0xFF000000 	;...extract SWI number 
		;r4 now contains SWI number 
		LDR     r5, =0x1234
		CMP		r4, r5
		BLEQ	ReverseR9			;call reverse subroutine
		LDMFD 	sp!, {r4-r5, pc}^	;Restore the register, status and return 
		
ReverseR9
		STMFD   sp!, {r4-r6, lr}
		MOV		r4,	#32				;r4 is loop counter
		MOV 	r5, r9				;save a copy of r9
		MOV		r2, #0				;result in r2
loop	AND		r6, r5, #1			;r7=LSB of reg to be reversed
		ADD		r2, r6, r2, LSL #1	;shift result left 1
		MOV		r5, r5, LSR #1		;look at new LSB of reg to be reversed
		SUBS	r4, r4, #1			;decrement counter
		BNE		loop				;loop if not finish
		LDMFD	sp!, {r4-r6, pc}	;return	 
 		END