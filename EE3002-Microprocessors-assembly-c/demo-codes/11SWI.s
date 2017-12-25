ram_base	EQU 0x40000000
Mode_USR	EQU 0x10

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
		SPACE 256	
		;handle FIQ here

		AREA resetHandler, CODE, READONLY
reset_handler
		;handle reset exception here

		LDR	sp,	=ram_base + 0x200	;init sp in supervisor mode
		MSR cpsr_c, #Mode_USR		;enter user mode, normal operating mode
		LDR sp, =ram_base + 0x100	;init sp in user mode
		SWI	1						;trigger software interrupt 1
stop	B stop					   	;return from SWI

undefined_instruction_handler B undefined_instruction_handler
		;handle undefined instruction exception here

		AREA swiHandler, CODE, READONLY
SWI_handler
		;handle software interrupt here
Tbit 	EQU	0x20 					;Thumb bit of CPSR/SPSR, that is, bit 5 
		STMFD   sp!, {r0-r2,lr} 	;Store registers
		MRS		r0, spsr 			;Move SPSR into general purpose register
		TST    	r0, #Tbit 			;Occurred in Thumb state? 

		LDRNEH 	r0,[lr,#-2] 		;Yes: load halfword and... 
		BICNE  	r0,r0,#0xFF00 		; ...extract SWI number 

		LDREQ  	r0,[lr,#-4] 		;No: load word and... 
		BICEQ  	r0,r0,#0xFF000000 	;...extract SWI number 
		;r0 now contains SWI number 

		LDR		r1, =switable		;load start address of swi jump table 
		LDRLS   pc, [r1, r0, LSL#2]	;Jump to the appropriate routine

switable 
		DCD   	do_swi_0 
		DCD    	do_swi_1
		DCD 	do_swi_2

do_swi_0
		;handle SWI 0
		ADD	  r2, r0, #0x100
		LDR   r1, =ram_base
		STR   r2, [r1]				;Store result in memory 
		LDMFD sp!, {r0-r2, pc}^		;Restore registers and return
do_swi_1 		
		;Handle SWI 1
		ADD   r2, r0, #0x500 
		LDR   r1, =ram_base
		STR   r2, [r1]				;Store result in memory 
		LDMFD sp!, {r0-r2, pc}^ 	;Restore registers and return. 
do_swi_2 
		;Handle SWI 2
		MOV   r2, #0
		LDR   r1, =ram_base
		STR   r2, [r1]				;Store result in memory 
		LDMFD sp!, {r0-r2, pc}^		;Restore registers and return 

prefetch_abort_handler 	B prefetch_abort_handler
		;handle prefetch abort exception here

data_abort_handler		B data_abort_handler
		;handle data abort exception here

IRQ_handler				B IRQ_handler
		;handle interrupt here
 		END