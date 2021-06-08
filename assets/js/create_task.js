var app = new Vue({
	el: '#content',
	data: {
		triger_group: 'null',
		meeting_title: null,
		name_task: null,
		driver_name: null,
		id_group: null,
		description: null,
		group: null,
		pilih_group: '<span class="bar"></span><label>Pilih Group</label>',
		error_lengkap: null,
		file: null,
		id_file: null,
		loading: false,
		time: null,
		due_date: null
	},

	methods: {

		pilihGroup: function() {
			this.pilih_group = null
		},

		uploadFile: function() {
			// this.file = this.$refs.file.files[0]
			console.log('upload file')
			console.table(this.file)
		},

		submitFile: function(id_booking) {

			let formData = new FormData()

			for( var i = 0; i < this.$refs.files.files.length; i++ ){
		        let file = this.$refs.files.files[i];
		        formData.append('files[' + i + ']', file);
		    }

			console.log('submit file')
			console.table(formData)

			axios
	          .post(url_upload, formData, {
	          	headers: {
                    'Content-Type': 'multipart/form-data'
                },
	          	auth: {
		        	username: 'caturindoapi',
	                password: 'caturindo123'
		        }
	          })
	          .then(data => {
		          console.table('hasil upload file '+data.data.status)
		          console.table(data.data)

		          if (data.data.status == true) {
		          	console.log('hore id file '+data.data.data.id)
		          	this.id_file = data.data.data
		          }

		          this.createTask()

		      })

		},

		createTask: function() {

			console.log('masok')

			if (!this.name_task) {
				this.error_lengkap = 'nama task wajib di isi'
			} else if (!this.id_group) {
				this.error_lengkap = 'Group title wajib di isi'
			} else if (!this.due_date) {
				this.error_lengkap = 'due date wajib di isi'
			} else if (!this.time) {
				this.error_lengkap = 'Time title wajib di isi'
			} else if (!this.description) {
				this.error_lengkap = 'Keterangan title wajib di isi'
			} else {

				var cek_data = {
		          	id_user: user_id,
		          	id_meeting: kode_meeting, 
		          	id_file: this.id_file,
		          	id_group: this.id_group,
		          	name_task: this.name_task,
		          	due_date: this.due_date,
		          	time: this.time,
		          	description: this.description
		        }

		        console.table(cek_data)
		        console.log('create task')

		        let url = 'http://caturindo.net/api/task/add_task'

		        axios
		          .post(url, cek_data, {
		          	auth: {
			        	username: 'caturindoapi',
		                password: 'caturindo123'
			        }
		          })
		          .then(data => {
			          console.table('data task '+data.data.status)
			          console.table(data.data)
			          if (data.data.status === false) {
			            this.error_lengkap = data.data.message
			          } else {

			          	console.log('data task berhasil ')
			          	console.table(data.data.data)

			          	if (data.data.status == true) {

			          		swal({
								title: 'Berhasil',
								text: data.data.message,
								icon: 'success'
							})
							.then((lempar) => {
								window.location.href = url_redirect
							})

			          	} else {

			          		swal({
								title: 'Berhasil',
								text: data.data.message,
								icon: 'error'
							})

			          	}

			          }
			        })
			      .catch(error => this.error_lengkap = error)
			      .finally(() => this.loading = false)

			}

		},

	},

	mounted() {

		axios({
			methods: 'get',
			url: 'https://caturindo.net/api/group',
			params: {
				id_user: user_id
			},
			auth: {
	        	username: 'caturindoapi',
                password: 'caturindo123'
	        },
			responseType: 'json',
		})
		.then(data => {
			if (data.data.status === true) {
			 	this.triger_group = 'true'
			 	this.group = data.data.data
			}
		})
	}

})