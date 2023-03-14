<template>
  <div>
    <v-card class="search-box" outlined>
      <v-row no-gutters class="d-flex justify-center align-center">
        <v-col cols="12" sm="6" class="pr-sm-2">
          <v-text-field v-model="keyword" dense :color="primaryColor" outlined class="search-input"
            placeholder="Search for hotels, places, and experiences"></v-text-field>
        </v-col>
        <v-col cols="12" sm="2" class="pr-sm-2" style="margin-top: -30px;">
          <v-btn class="search-btn" @click="search()" :color="primaryColor">Search</v-btn>
        </v-col>
      </v-row>
    </v-card>



    <div>
      <v-card style="padding: 20px;margin-top: 20px;">
        <v-data-table dense class="table-map" :headers="headers" :items="this.restaurants" mobile-breakpoint="0"
          item-key="display_name" head-variant="primary" :header-color="primaryColor">
          <template v-slot:item.rating="{ item }">
            <v-rating :value="item.rating" half-increments></v-rating>
          </template>
        </v-data-table>

      </v-card>
    </div>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  data() {
    return {
      primaryColor: "#1bbb6e",
      keyword: 'Bang sue',
      restaurants: [],
    };
  },
  mounted() {
    this.search();
  },
  computed: {
    items() {
      return this.restaurants;
    },
    headersContent() {
      return [
        {
          text: "Restaurant Name",
          align: "start",
          sortable: false,
          value: "name",
          width: "250px",
        },
        {
          text: "Rating",
          align: "center",
          sortable: true,
          value: "rating",
          width: "100px",
        },
        {
          text: "Location",
          align: "start",
          sortable: false,
          value: "formatted_address",
          width: "250px",
        },
      ];
    },
    headers() {
      return this.headersContent;
    },
  },
  methods: {
    async search() {
      const cachedResult = sessionStorage.getItem(this.keyword);
      // รับค่า this.keyword 
      if (cachedResult) {
        //ตรวจสอบว่ามีข้อมูล cachedResult ถ้ามีให้ return ข้อมูลออกไปเลยไม่ต้องเรียก API ใหม่
        this.restaurants = JSON.parse(cachedResult);
        return;
      }
      try {
        //หากไม่มีผลลัพธ์การค้นหาที่ถูก cache ไว้ใน sessionStorage จะส่ง request ไปที่ API และ set ค่า cachedResult เก็บไว้
        const response = await this.$axios.get(`${this.keyword}`);
        this.restaurants = response.data.results;
        sessionStorage.setItem(this.keyword, JSON.stringify(this.restaurants));
      } catch (error) {
        console.log(error);
      }

    },
  },
}
</script>

<style>
.search-box {
  background-color: #f9f9f9;
  padding: 20px;
}

.search-input {
  background-color: #ffffff;
}

.search-filter {
  background-color: #ffffff;
}

.search-btn {
  color: #ffffff !important;

}

.search-btn:hover {
  background-color: #1bbb6e;
}

.v-select__selection--comma.v-select__selection {
  padding-left: 10px;
  padding-right: 10px;
}

.table-map {
  background-color: white;
  border: 1px solid #ddd;
  border-collapse: collapse;
  font-size: 14px;
  width: 100%;
}

.table-map th {
  font-weight: bold;
  color: #ffffff !important;
  background-color: #1bbb6e;
  border-color: #1bbb6e;
  font-weight: 500;
  font-size: 1.5em;
}




.table-map td {
  border: 1px solid #ddd;
  padding: 8px;
}

.table-map tr:nth-child(even) {
  background-color: #f2f2f2;
}

.table-map tr:hover {
  background-color: #e0e0e0;
}

.v-rating__icon {
  color: #ffd055;
}

.v-rating__icon--on {
  color: #ff9800;
}
</style>
