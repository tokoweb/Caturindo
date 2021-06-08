
var app = new Vue({
	el: '#content',
	data: {
		triger_group: 'null',
		meeting_title: null,
		id_group: null,
		description: null,
		group: null,
		pilih_group: '<span class="bar"></span><label>Pilih Group</label>',
		error_lengkap: null,
		file: null,
		// id_booking: null,
		id_file: null
	},

	methods: {

		bookingRuangan: function() {

			let uri = window.location.search.substring(1)
		    let params = new URLSearchParams(uri)
			console.log(params.get("waktu_selesai"))

			if (!this.meeting_title) {
				this.error_lengkap = 'Meeting title wajib di isi'
			} else if (!this.id_group) {
				this.error_lengkap = 'Group title wajib di isi'
			} else if (!this.description) {
				this.error_lengkap = 'Keterangan title wajib di isi'
			} else {

				var cek_data = {
		          	id_user: user_id,
		          	code_room: kode_ruangan,
		          	date: params.get("tanggal"),
		          	time_start: params.get("waktu_mulai"),
		          	time_end: params.get("waktu_selesai"),
		          	note: this.description
		        }

		        console.table(cek_data)

		        let url = 'http://caturindo.net/api/booking/create'

		        axios
		          .post(url, cek_data, {
		          	auth: {
			        	username: 'caturindoapi',
		                password: 'caturindo123'
			        }
		          })
		          .then(data => {
			          console.table('data booking '+data.data.status)
			          console.table(data.data)
			          if (data.data.status === false) {
			            // this.error_lengkap = data.data.message
			            swal({
							title: 'Gagal',
							text: data.data.message,
							icon: 'error'
						})
			          } else {

			          	console.log('data booking berhasil ')
			          	console.table(data.data.data)
			          	console.log('id booking '+ data.data.data[0].id)

			          	this.submitFile(data.data.data[0].id)

			          }
			        })
			      .catch(error => this.error_lengkap = error)
			      .finally(() => this.loading = false)

			}

		},

		pilihGroup: function() {
			console.log('id_group '+this.id_group)
			this.pilih_group = null
		},

		createMeeting: function(id_booking) {

			let uri = window.location.search.substring(1)
		    let params = new URLSearchParams(uri)

			var post_meeting = {
	          	id_user: user_id,
	          	id_booking: id_booking,
	          	id_file: this.id_file,
	          	id_group: this.id_group,
	          	title: this.meeting_title,
	          	description: this.description,
	          	date: params.get("tanggal"),
	          	time: params.get("waktu_mulai"),
	          	location: nama_ruangan
	        }

	        console.table(post_meeting)
	        console.log('crate meeting')

	        let url = 'http://caturindo.net/api/meeting/create'

	        axios
	          .post(url, post_meeting, {
	          	auth: {
		        	username: 'caturindoapi',
	                password: 'caturindo123'
		        }
	          })
	          .then(data => {
		          console.table('data booking '+data.data.status)
		          console.table(data.data)
		          if (data.data.status === false) {
		            this.error_lengkap = data.data.message
		          } else {

		          	console.log('data meeting berhasil ')
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

		},

		submitFile: function(id_booking) {

			let formData = new FormData()
			console.log('file upload 1 '+this.$refs.files.files)
			console.table(this.$refs.files.files)
			console.log('file upload 2 ')
			console.table(this.file)
			for( var i = 0; i < this.$refs.files.files.length; i++ ){
		        let file = this.$refs.files.files[i];
		        console.log('file upload '+file)
		        console.table(file)
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
		          console.log('hore id file '+data.data.data.id)
		          
	              if (data.data.status == true) {
	                console.log('berhasil '+data.data.data)
		          	this.id_file = data.data.data
	              }

	              this.createMeeting(id_booking)

		      })

		},

		uploadFile: function() {
			// this.file = this.$refs.file.files[0]
			console.table(this.$refs.files.files)
			console.log('upload file')
			console.table(this.file)
			let formData = new FormData()

			for( var i = 0; i < this.$refs.files.files.length; i++ ){
		        let file = this.$refs.files.files[i];
		        formData.append('files[' + i + ']', file);
		    }
		    console.log('hasil')
		    console.table(formData)
		    this.file = this.$refs.files.files
		},

		kembali: function() {
			window.location.href = url_kembali
		},

	},
	mounted() {

		let url = 'https://caturindo.net/api/group'
		axios({
			methods: 'get',
			url: url,
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