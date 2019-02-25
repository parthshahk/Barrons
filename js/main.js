var app = new Vue({
    el: '#app',

    data: {
        view: 'stage',
        word: '',
        defs: [],
        activeDef: '',
        nextWord:'',
        nextDefs:[],
        counter:0
    },

    methods: {

        cycleDef: function(){

            var length  = this.defs.length;
            
            if(this.activeDef == length-1)
                this.activeDef = 0;
            else
                this.activeDef++;
            
        },

        fetchWord: function(){
        
            var cacheControl = Math.random();

            var self = this;

            this.word = this.nextWord;
            this.defs = this.nextDefs;
            this.activeDef = this.defs.length-1;
            this.counter++;

            axios.get('./api/words.php?action=getRandom&nocache='+cacheControl)
                .then(function(response){

                    self.nextWord = response.data.word;
                    self.nextDefs = response.data.definition;
                    self.nextDefs.push("");
                })
        }
    },

    mounted: function(){

        var cacheControl = Math.random();

        var self = this;
        axios.get('./api/words.php?action=getRandom&nocache='+cacheControl)
            .then(function(response){

                self.nextWord = response.data.word;
                self.nextDefs = response.data.definition;
                self.nextDefs.push("");
                self.activeDef = self.nextDefs.length-1;
                self.fetchWord();
            })
    }
});

var appWrapper = document.getElementById("appBackground");
var hammertime = new Hammer(appWrapper);

hammertime.on('swipeleft', function() {
    app.fetchWord();
});

hammertime.on('swipeup', function() {
    app.cycleDef();
});

hammertime.get('swipe').set({ velocity: 0.1, direction: Hammer.DIRECTION_ALL });