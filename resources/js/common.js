export default {
	data(){
		return {

		}
	},
	methods: {

		async callApi(method, url, dataObj){			
			try {			 			
				return await axios({
				method: method,
				url: url,
				data: dataObj
			})
			}			
			catch(e){				
			return e.response
			}
		},
		i (desc, title="Hello") {
		    this.$Notice.info({
		        title: title,
		        desc: desc
		    });
		},
		s (desc, title="Bingo!") {
		    this.$Notice.success({
		         title: title,
		         desc: desc
		    });
		},
		w (desc, title="Warning") {
		    this.$Notice.warning({
		         title: title,
		        desc: desc
		    });
		},
		swr (desc="Something went wrong, Please try again", title="Aww Snap") {
		    this.$Notice.warning({
		         title: title,
		         desc: desc
		    });
		},
		e (desc, title="Oops") {
		    this.$Notice.error({
		         title: title,
		        desc: desc
		    });
		},
		start () {
		   this.$Loading.start();
		},
		stop () {
		   this.$Loading.finish()
		},
		showError () {
		   this.$Loading.error()
		},
	},


}
