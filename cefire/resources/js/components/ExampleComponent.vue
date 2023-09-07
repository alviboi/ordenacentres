<template>
  <div class="groups" style="border: solid 3px;">

    <div class="group" style="border: dashed 3px;" v-for="(ass, index) in assessors" :key="index">
      <div style="height: 130px; font-size: 12px;">
        Nom: {{ ass }}<br>
        Centres: {{ dades(ass)['total'] }}<br>
        Publics: {{ dades(ass)['pub'] }}<br>
        Privats: {{ dades(ass)['priv'] }}<br>
      </div>
      <Container
        group-name="ass"
        :get-child-payload="(itemIndex) => getChildPayload(index, itemIndex)"
        @drop="onDrop(ass,$event)"
      >
        <Draggable v-for="item in aux(ass)" :key="item.id">
          <div style="font-size: 11px; border: solid 1px;" :id="item.id">
            {{ item.nom }}
            <br>
            {{ item['2ANYS']?"2anys":"-" }} 
            {{ item['PROA']?"PROA":"-" }} 
            {{ item['Aula CIL']?"UECO":"-" }} 
            {{ item['situacio']}} 
            <!-- <p>Aula CIL: {{ item['Aula CIL'] }}</p> -->
          </div>
        </Draggable>
      </Container>
    </div>

  </div>
</template>

<script>
import { Container, Draggable } from "vue-dndrop";
import { applyDrag, generateItems } from "../utils/helpers";

export default {
  name: "Groups",

  components: { Container, Draggable },

  data() {
    return {
      agafant: {},
      itemtot: {},
      itemsalf: {},
      items: {},
      assessors: [
        'Alfredo Rafael Vicente Boix',
        'Rosa Mª Gomar Sanz',
        'Carlos Settier',
        'FPA',
        'PLURILINGUISME2',
        'INFANTIL2',
        'ARTISTICEXPRESIU',
        'Núria del Valle',
        'Carmen Siurana Altabás',
        'Marta INCLUSIVA',
        'Alicia Alcaraz González',
        'CARLOS DAMIÁN FUENTES FOS',
        'cap',
        'Amelia'
    ]
      


      // itemsalf: generateItems(15, (i) => ({
      //   id: "1" + i,
      //   data: `Draggable 1 - ${i}`,
      // })),
      // items2: generateItems(15, (i) => ({
      //   id: "2" + i,
      //   data: `Draggable 2 - ${i}`,
      // })),
      // items3: generateItems(15, (i) => ({
      //   id: "3" + i,
      //   data: `Draggable 3 - ${i}`,
      // })),
      // items4: generateItems(15, (i) => ({
      //   id: "4" + i,
      //   data: `Draggable 3 - ${i}`,
      // })),
    };
  },

  methods: {
    onDrop(ass,dropResult) {
      //this[collection] = applyDrag(this[collection], dropResult);
      console.log(dropResult);
      console.log(ass);
      //alert(dropResult.element.id);
      if (dropResult.addedIndex !== null){
        var foundIndex = this.itemtot.findIndex(x => x.id == dropResult.element.id);
        this.itemtot[foundIndex]['assessor'] = ass;
        var url = "centres/"+ this.itemtot[foundIndex]['id'];

        

        axios.put(url,this.itemtot[foundIndex])
        .then(res => {
          console.log(res)
        })
        .catch(err => {
          console.error(err); 
        })
      }
      

    },

    agafa_dades() {

      var params = {
        nom: "Alfredo Rafael Vicente Boix"
      };

      var url = "centres";

      axios.get(url)
      .then(res => {
        this.itemtot = res.data;
        //this.items['Alfredo Rafael Vicente Boix'] = Object.values(this.itemtot).filter(item => item.assessor === 'Alfredo Rafael Vicente Boix');
        
        //this.itemsalf = Object.values(res.data).filter(item => item.assessor === 'Alfredo Rafael Vicente Boix');
        //console.log(this.itemsalf)
      })
      .catch(err => {
        console.error(err); 
      })
    },

    getChildPayload(groupIndex, itemIndex) {
      //alert(itemIndex);
      return groupIndex;
    },
    aux(ass){
      return Object.values(this.itemtot).filter(item => item.assessor === ass);
    },
    dades(ass) {
      var itemsalf = this.aux(ass);
      var priv = Object.values(itemsalf).filter(item => item.situacio === 'CON.').length;
      var pub = Object.values(itemsalf).filter(item => item.situacio === 'PUB.').length;
      var total = itemsalf.length;
      var ret = {
        'pub': pub,
        'priv': priv,
        'total': total
      };
      return ret;
    }
  },

  mounted() {
    this.agafa_dades();
  },

  computed: {
    
    // aux(ass){
    //   return Object.values(this.itemtot).filter(item => item.assessor === ass);
    // }
  },
};
</script>

<style lang="css" scoped>
.groups {
  display: flex;
  justify-content: stretch;
}

.group {
  flex: 1;
}

</style>