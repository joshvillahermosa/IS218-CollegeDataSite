var ToolsView = Backbone.View.extend({
	template: Handlebars.compile(
		'<h3>Web Development Tools</h3>'+
        '<p>Note: All tools made with the development of this Website are NOT tools created by me. They belong to thier respective developers to bring a awesome user expernence. ALL COPYRIGHT FOR THE FOLLOWING TOOLS BELONG TO THEIR RESPECTIVE DEVELOPERS. The following are the web development tools to make this awesome website/webapp.</p>'+
		'<h4>Client Side</h4>'+
            '<ul>'+
                '<li><a href="http://html5boilerplate.com">HTML5 Boilerplate</a></li>'+
                '<li><a href="http://backbonejs.org/">Backbone.js</a></li>'+
                '<li><a href="http://underscorejs.org/">Underscore.js</a></li>'+
                '<li><a href="http://jquery.malsup.com/cycle/">JQuery Cylce</a></li>'+
                '<li><a href="http://getbootstrap.com/">Twitter Bootstrap</a></li>'+
                '<li><a href="http://jquery.com/">JQuery</a></li>'+
                '<li><a href="http://handlebarsjs.com/">Handlebars.js</a></li>'+
            '</ul> '
	),
	render: function(){
		this.$el.html(this.template());
		return this;
	}
})