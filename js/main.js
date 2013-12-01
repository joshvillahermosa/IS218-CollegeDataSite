/*
MAIN.JS
Also known as the router for Backbone.js.
Created by Joshua John Villahermosa
*/
var AppRouter = Backbone.Router.extend({
	routes:{
		"":"",
		"tools": "loadTools"
	},

	initialize: function(){
		this.toolsView = new ToolsView(); 

	},

	loadTools: function(){
		$('#tools').html(this.toolsView.render().el);
	}
});

var appRouter = new AppRouter();

$(function  () {
	Backbone.history.start();
})