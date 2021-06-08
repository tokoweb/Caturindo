var app = new Vue({
  el: '#content',
  data: {
    kode_meeting: kode_meeting,
    lokasi_meeting: 'null',
    ruangan: null,
    transport: null,
    tanggal: null,
    waktu_mulai: null,
    waktu_selesai: null, 
    loading: null,
    error_lengkap: null
  },

  watch: {
    tanggal: function () {
      console.log(tanggal)
    }
  },
  methods: {
    diRuangan: function() {
      this.lokasi_meeting = 'didalam'
    },
    diLuarRuangan: function() {
      console.log('masok di luar')
      this.lokasi_meeting = 'diluar'
    },
    kembali: function() {
      this.lokasi_meeting = 'null'
    },
    cariRuangan: function() {

      function convertTZ(date, tzString) {
          return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
      }
      let tanggal_pilih = new Date(this.tanggal)
      let tanggal_pilih_hari_ini = tanggal_pilih.setDate(tanggal_pilih.getDate() + 1)
      let hari_ini = new Date()
      let sekarang = hari_ini.setDate(hari_ini.getDate())
      let tes = hari_ini.getDate() + 1
      // let hari_ini_v2 = convertTZ(hari_ini.getDate(), "Asia/Jakarta")
      // console.log('masuk '+ tes)
      this.ruangan = null
      this.loading = true
      if (!this.tanggal) {
        this.error_lengkap = ("Tanggal harus di isi") 
      } else if (tanggal_pilih_hari_ini < sekarang) {
        this.error_lengkap = ('Ruangan hanya tersedia untuk hari ini atau besok')
      } else if (!this.waktu_mulai) {
        this.error_lengkap = ('Waktu mulai harus di isi')
      } else if (!this.waktu_selesai) {
        this.error_lengkap = ('Waktu selesai harus di isi')
      } else {

        this.error_lengkap = null
        axios({
          method: 'get',
          url: 'https://caturindo.net/api/rooms',
          params: {
            status_booking: null,
            time_start: this.waktu_mulai,
            time_end: this.waktu_selesai,
            tanggal: this.tanggal
          },
          auth: {
              username: 'caturindoapi',
              password: 'caturindo123'
            },
            responseType: 'json',
        })
        .then(response => response)
        .then(data => {
          console.log('data caturindo '+data.data.data[0].name_ruangan)
          if (!data.data.data) {
            this.error_lengkap = ('Ruangan sedang di gunakan semua')
          } else {
            this.ruangan = data.data.data
          }
        })
        .catch(error => console.log(error))
        .finally(() => this.loading = null)

      }

    },
    cariTransport: function() {

      function convertTZ(date, tzString) {
          return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
      }
      let tanggal_pilih = new Date(this.tanggal)
      let tanggal_pilih_hari_ini = tanggal_pilih.setDate(tanggal_pilih.getDate() + 1)
      let hari_ini = new Date()
      let sekarang = hari_ini.setDate(hari_ini.getDate())
      let tes = hari_ini.getDate() + 1
      this.ruangan = null
      this.loading = true
      if (!this.tanggal) {
        this.error_lengkap = ("Tanggal harus di isi") 
      } else if (tanggal_pilih_hari_ini < sekarang) {
        this.error_lengkap = ('Transport hanya tersedia untuk hari ini atau besok')
      } else if (!this.waktu_mulai) {
        this.error_lengkap = ('Waktu mulai harus di isi')
      } else if (!this.waktu_selesai) {
        this.error_lengkap = ('Waktu selesai harus di isi')
      } else {

        this.error_lengkap = null
        axios({
          method: 'get',
          url: 'https://caturindo.net/api/transport',
          params: {
            status_booking: null,
            time_start: this.waktu_mulai,
            time_end: this.waktu_selesai,
            tanggal: this.tanggal
          },
          auth: {
              username: 'caturindoapi',
              password: 'caturindo123'
            },
            responseType: 'json',
        })
        .then(response => response)
        .then(data => {
          console.log('data caturindo '+data.data.data[0].name_transport)
          if (!data.data.data) {
            this.error_lengkap = ('Transport sedang di gunakan semua')
          } else {
            this.transport = data.data.data
          }
        })
        .catch(error => console.log(error))
        .finally(() => this.loading = null)

      }

    }
  }
})