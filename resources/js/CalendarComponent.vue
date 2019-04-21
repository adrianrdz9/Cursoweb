<template>
<div class="container">
  <button class="btn btn-info d-block ml-auto" @click="showAll">Mostrar todo</button>
  <vue-event-calendar :events="events" :title="title">
    <template scope="props">
      <div v-for="(event, index) in props.showEvents" :key="index" class="event-item p-0" style="background-color: transparent">
          <div class="card">
            <div class="card-header">
              <h3 class="title"> {{ event.title }} </h3>
              <a class="time" style="color: #3490dc;" href="#" @click="goTo(event.date)"> {{ event.date.split("/").reverse().join("/") }} </a>
            </div>

            <div class="card-body">
              <div class="dec" v-html="event.desc"></div>
            </div>

            <div class="card-footer">
              <a :href="'/assignment/'+event.id" class="btn btn-info">Ir</a>
            </div>
        </div>
      </div>
    </template>
  </vue-event-calendar>
</div>
</template>

<script>
export default {

  props: {
    assignments: Array,
  },

  data () {
    return {
      events: [],
      title: "Trabajos"
    }
  },
  methods: {
    showAll(){
      this.$EventCalendar.toDate("all");
    },

    goTo(date){
      this.$EventCalendar.toDate(date);
    }
  },

  mounted(){

    this.assignments.forEach(assignment => {
      this.events.push({
        date: moment(assignment.deadline).format("YYYY[/]MM[/]DD"),
        title: assignment.title,
        desc: assignment.description,
        id: assignment.id
      })
    });

  }
}
</script>

