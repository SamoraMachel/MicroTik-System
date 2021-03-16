<template>
	<div>
		<button type="button" @click="InitiatePurchase(sel_package)" class="btn btn-white btn-block text-dark font-weight-bold animate-up-2"
		    tabindex="0" data-toggle="modal">
		 <span class="fas fa-money-check-alt" ></span> Purchase </button>
		 <Modal v-model="purchaseModal" :closable="false" :mask-closable="false" :width="85">
		 	<div slot="header">Purchase Subscription</div>
		 	<div class="row justify-content-center">
		 		<div class="col-sm-9">
		 			<div class="input-group">
		 				<input class="input--style-2" type="text" placeholder="Enter Your Phone Number: " v-model="data.phone_number">
		 			</div>
		 		</div>
		 	</div>
		 	<div slot="footer">
		 		<button class="btn btn--radius btn--green" @click="purchaseModal=false">Cancel</button>
		 		<button class="btn btn--radius btn--green" :disabled="isSaving" @click="confirmPurchase" type="submit">{{isSaving ? 'Purchasing...' : 'Proceed'}}</button>		 		
		 	</div>
		 </Modal>
	</div>
</template>
<script>
	export default{
		data(){
			return {
				data:{
					phone_number:'',
					id:'',
				},
				purchaseModal:false,
				isSaving:false,
			}
		},
		props:{
			sel_package:Object,
		},
		methods:{
			InitiatePurchase(sub_package){
				this.data.id = sub_package.id
				this.purchaseModal =true
			},
			async confirmPurchase(){
				this.isSaving = true
				if (this.data.phone_number=='') {
					this.isSaving = false
					return this.e('Phone Number is required')
				}

				const res = await this.callApi('post', '/customer/purchase', this.data)				
				if (res.status == 200) {
					console.log(res.data)
					if (res.data.ResponseCode == 0) {
						this.s('Purchase Initiated,check your phone')
					}else{
						this.i('Problem Encountered During Purchase. Please Try Again')
					}
					this.data.id=''
					this.purchaseModal = false
					this.isSaving = false
				}else{
					this.isSaving = false
					if (res.status == 422) {
						for (let i in res.data.errors) {
							this.e(res.data.errors[i][0])
						}
					}else{
						this.swr('Something Went Wrong')
					}
				}
			}
		}
	}
</script>