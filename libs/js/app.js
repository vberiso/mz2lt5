/*!
 *
 * Angle - Bootstrap Admin App + jQuery
 *
 * Version: 3.7.5
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: https://wrapbootstrap.com/help/licenses
 *
 */

 
!function(e,t,o,a){if(void 0===o)throw new Error("This application's JavaScript requires jQuery");
o(function(){
	var e=o("body");
	(new StateToggler).restoreState(e),o("#chk-fixed").prop("checked",e.hasClass("layout-fixed")),o("#chk-collapsed").prop("checked",e.hasClass("aside-collapsed")),o("#chk-collapsed-text").prop("checked",e.hasClass("aside-collapsed-text")),o("#chk-boxed").prop("checked",e.hasClass("layout-boxed")),o("#chk-float").prop("checked",e.hasClass("aside-float")),o("#chk-hover").prop("checked",e.hasClass("aside-hover")),o(".offsidebar.hide").removeClass("hide"),o.ajaxPrefilter(function(e,t,o){e.async=!0})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o('[data-toggle="popover"]').popover(),o('[data-toggle="tooltip"]').tooltip({container:"body"}),o(".dropdown input").on("click focus",function(e){e.stopPropagation()})})}(window,document,window.jQuery),function(e,t,o,a){function n(e,t){var a=o("#remove-after-drop");e.fullCalendar({header:{left:"prev,next today",center:"title",right:"month,agendaWeek,agendaDay"},buttonIcons:{prev:" fa fa-caret-left",next:" fa fa-caret-right"},buttonText:{today:"today",month:"month",week:"week",day:"day"},editable:!0,droppable:!0,drop:function(t,n){var r=o(this),i=r.data("calendarEventObject");if(i){var s=o.extend({},i);s.start=t,s.allDay=n,s.backgroundColor=r.css("background-color"),s.borderColor=r.css("border-color"),e.fullCalendar("renderEvent",s,!0),a.is(":checked")&&r.remove()}},eventDragStart:function(e,t,o){s=e},events:t})}function r(e){var t=o(".external-events");new l(t.children("div"));var a="#f6504d",n=o(".external-event-add-btn"),r=o(".external-event-name"),i=o(".external-event-color-selector .circle");o(".external-events-trash").droppable({accept:".fc-event",activeClass:"active",hoverClass:"hovered",tolerance:"touch",drop:function(t,o){if(s){var a=s.id||s._id;e.fullCalendar("removeEvents",a),o.draggable.remove(),s=null}}}),i.click(function(e){e.preventDefault();var t=o(this);a=t.css("background-color"),i.removeClass("selected"),t.addClass("selected")}),n.click(function(e){e.preventDefault();var n=r.val();if(""!==o.trim(n)){var i=o("<div/>").css({"background-color":a,"border-color":a,color:"#fff"}).html(n);t.prepend(i),new l(i),r.val("")}})}function i(){var e=new Date,t=e.getDate(),o=e.getMonth(),a=e.getFullYear();return[{title:"All Day Event",start:new Date(a,o,1),backgroundColor:"#f56954",borderColor:"#f56954"},{title:"Long Event",start:new Date(a,o,t-5),end:new Date(a,o,t-2),backgroundColor:"#f39c12",borderColor:"#f39c12"},{title:"Meeting",start:new Date(a,o,t,10,30),allDay:!1,backgroundColor:"#0073b7",borderColor:"#0073b7"},{title:"Lunch",start:new Date(a,o,t,12,0),end:new Date(a,o,t,14,0),allDay:!1,backgroundColor:"#00c0ef",borderColor:"#00c0ef"},{title:"Birthday Party",start:new Date(a,o,t+1,19,0),end:new Date(a,o,t+1,22,30),allDay:!1,backgroundColor:"#00a65a",borderColor:"#00a65a"},{title:"Open Google",start:new Date(a,o,28),end:new Date(a,o,29),url:"//google.com/",backgroundColor:"#3c8dbc",borderColor:"#3c8dbc"}]}if(o.fn.fullCalendar){o(function(){var e=o("#calendar"),t=i();r(e),n(e,t)});var s=null,l=function(e){e&&e.each(function(){var e=o(this),t={title:o.trim(e.text())};e.data("calendarEventObject",t),e.draggable({zIndex:1070,revert:!0,revertDuration:0})})}}}(window,document,window.jQuery),function(e,t,o,a){o(function(){if(o.fn.easyPieChart){var e={animate:{duration:800,enabled:!0},barColor:APP_COLORS.success,trackColor:!1,scaleColor:!1,lineWidth:10,lineCap:"circle"};o("#easypie1").easyPieChart(e);var t={animate:{duration:800,enabled:!0},barColor:APP_COLORS.warning,trackColor:!1,scaleColor:!1,lineWidth:4,lineCap:"circle"};o("#easypie2").easyPieChart(t);var a={animate:{duration:800,enabled:!0},barColor:APP_COLORS.danger,trackColor:!1,scaleColor:APP_COLORS.gray,lineWidth:15,lineCap:"circle"};o("#easypie3").easyPieChart(a);var n={animate:{duration:800,enabled:!0},barColor:APP_COLORS.danger,trackColor:APP_COLORS.yellow,scaleColor:APP_COLORS["gray-dark"],lineWidth:15,lineCap:"circle"};o("#easypie4").easyPieChart(n)}})}(window,document,window.jQuery),function(e,t,o,a){o(function(){if(o.fn.knob){var e={width:"50%",displayInput:!0,fgColor:APP_COLORS.info};o("#knob-chart1").knob(e);var t={width:"50%",displayInput:!0,fgColor:APP_COLORS.purple,readOnly:!0};o("#knob-chart2").knob(t);var a={width:"50%",displayInput:!0,fgColor:APP_COLORS.info,bgColor:APP_COLORS.gray,angleOffset:-125,angleArc:250};o("#knob-chart3").knob(a);var n={width:"50%",displayInput:!0,fgColor:APP_COLORS.pink,displayPrevious:!0,thickness:.1,lineCap:"round"};o("#knob-chart4").knob(n)}})}(window,document,window.jQuery),function(e,t,o,a){o(function(){if("undefined"!=typeof Chart){var e=function(){return Math.round(100*Math.random())},o={labels:["January","February","March","April","May","June","July"],datasets:[{label:"My First dataset",backgroundColor:"rgba(114,102,186,0.2)",borderColor:"rgba(114,102,186,1)",pointBorderColor:"#fff",data:[e(),e(),e(),e(),e(),e(),e()]},{label:"My Second dataset",backgroundColor:"rgba(35,183,229,0.2)",borderColor:"rgba(35,183,229,1)",pointBorderColor:"#fff",data:[e(),e(),e(),e(),e(),e(),e()]}]},a={legend:{display:!1}},n=t.getElementById("chartjs-linechart").getContext("2d"),r=(new Chart(n,{data:o,type:"line",options:a}),{labels:["January","February","March","April","May","June","July"],datasets:[{backgroundColor:"#23b7e5",borderColor:"#23b7e5",data:[e(),e(),e(),e(),e(),e(),e()]},{backgroundColor:"#5d9cec",borderColor:"#5d9cec",data:[e(),e(),e(),e(),e(),e(),e()]}]}),i={legend:{display:!1}},s=t.getElementById("chartjs-barchart").getContext("2d"),l=(new Chart(s,{data:r,type:"bar",options:i}),{labels:["Purple","Yellow","Blue"],datasets:[{data:[300,50,100],backgroundColor:["#7266ba","#fad732","#23b7e5"],hoverBackgroundColor:["#7266ba","#fad732","#23b7e5"]}]}),c={legend:{display:!1}},d=t.getElementById("chartjs-doughnutchart").getContext("2d"),u=(new Chart(d,{data:l,type:"doughnut",options:c}),{labels:["Purple","Yellow","Blue"],datasets:[{data:[300,50,100],backgroundColor:["#7266ba","#fad732","#23b7e5"],hoverBackgroundColor:["#7266ba","#fad732","#23b7e5"]}]}),f={legend:{display:!1}},p=t.getElementById("chartjs-piechart").getContext("2d"),h=(new Chart(p,{data:u,type:"pie",options:f}),{datasets:[{data:[11,16,7,3],backgroundColor:["#f532e5","#7266ba","#f532e5","#7266ba"],label:"My dataset"}],labels:["Label 1","Label 2","Label 3","Label 4"]}),g={legend:{display:!1}},m=t.getElementById("chartjs-polarchart").getContext("2d"),y=(new Chart(m,{data:h,type:"polarArea",options:g}),{labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],datasets:[{label:"My First dataset",backgroundColor:"rgba(114,102,186,0.2)",borderColor:"rgba(114,102,186,1)",data:[65,59,90,81,56,55,40]},{label:"My Second dataset",backgroundColor:"rgba(151,187,205,0.2)",borderColor:"rgba(151,187,205,1)",data:[28,48,40,19,96,27,100]}]}),v={legend:{display:!1}},w=t.getElementById("chartjs-radarchart").getContext("2d");new Chart(w,{data:y,type:"radar",options:v})}})}(window,document,window.jQuery),function(e,t,o,a){o(function(){if("undefined"!=typeof Chartist){var t={labels:["W1","W2","W3","W4","W5","W6","W7","W8","W9","W10"],series:[[1,2,4,8,6,-2,-1,-4,-6,-2]]},o={high:10,low:-10,height:280,axisX:{labelInterpolationFnc:function(e,t){return t%2==0?e:null}}};new Chartist.Bar("#ct-bar1",t,o),new Chartist.Bar("#ct-bar2",{labels:["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],series:[[5,4,3,7,5,10,3],[3,2,9,5,4,6,4]]},{seriesBarDistance:10,reverseData:!0,horizontalBars:!0,height:280,axisY:{offset:70}}),new Chartist.Line("#ct-line1",{labels:["Monday","Tuesday","Wednesday","Thursday","Friday"],series:[[12,9,7,8,5],[2,1,3.5,7,3],[1,3,4,5,6]]},{fullWidth:!0,height:280,chartPadding:{right:40}});new Chartist.Line("#ct-line3",{labels:["Mon","Tue","Wed","Thu","Fri","Sat"],series:[[1,5,2,5,4,3],[2,3,4,8,1,2],[5,4,3,2,1,.5]]},{low:0,showArea:!0,showPoint:!1,fullWidth:!0,height:300}).on("draw",function(e){"line"!==e.type&&"area"!==e.type||e.element.animate({d:{begin:2e3*e.index,dur:2e3,from:e.path.clone().scale(1,0).translate(0,e.chartRect.height()).stringify(),to:e.path.clone().stringify(),easing:Chartist.Svg.Easing.easeOutQuint}})});var a=new Chartist.Line("#ct-line2",{labels:["1","2","3","4","5","6","7","8","9","10","11","12"],series:[[12,9,7,8,5,4,6,2,3,3,4,6],[4,5,3,7,3,5,5,3,4,4,5,5],[5,3,4,5,6,3,3,4,5,6,3,4],[3,4,5,6,7,6,4,5,6,7,6,3]]},{low:0,height:300}),n=0;a.on("created",function(){n=0}),a.on("draw",function(e){if(n++,"line"===e.type)e.element.animate({opacity:{begin:80*n+1e3,dur:500,from:0,to:1}});else if("label"===e.type&&"x"===e.axis)e.element.animate({y:{begin:80*n,dur:500,from:e.y+100,to:e.y,easing:"easeOutQuart"}});else if("label"===e.type&&"y"===e.axis)e.element.animate({x:{begin:80*n,dur:500,from:e.x-100,to:e.x,easing:"easeOutQuart"}});else if("point"===e.type)e.element.animate({x1:{begin:80*n,dur:500,from:e.x-10,to:e.x,easing:"easeOutQuart"},x2:{begin:80*n,dur:500,from:e.x-10,to:e.x,easing:"easeOutQuart"},opacity:{begin:80*n,dur:500,from:0,to:1,easing:"easeOutQuart"}});else if("grid"===e.type){var t={begin:80*n,dur:500,from:e[e.axis.units.pos+"1"]-30,to:e[e.axis.units.pos+"1"],easing:"easeOutQuart"},o={begin:80*n,dur:500,from:e[e.axis.units.pos+"2"]-100,to:e[e.axis.units.pos+"2"],easing:"easeOutQuart"},a={};a[e.axis.units.pos+"1"]=t,a[e.axis.units.pos+"2"]=o,a.opacity={begin:80*n,dur:500,from:0,to:1,easing:"easeOutQuart"},e.element.animate(a)}}),a.on("created",function(){e.__exampleAnimateTimeout&&(clearTimeout(e.__exampleAnimateTimeout),e.__exampleAnimateTimeout=null),e.__exampleAnimateTimeout=setTimeout(a.update.bind(a),12e3)})}})}(window,document,window.jQuery),function(e,t,o){"use strict";e(o).on("click","[data-reset-key]",function(o){o.preventDefault();var a=e(this).data("resetKey");a?(e.localStorage.remove(a),t.location.reload()):e.error("No storage key specified for reset.")})}(jQuery,window,document),function(e,t,o,a){o(function(){o.fn.colorpicker&&(o(".demo-colorpicker").colorpicker(),o("#demo_selectors").colorpicker({colorSelectors:{default:"#777777",primary:APP_COLORS.primary,success:APP_COLORS.success,info:APP_COLORS.info,warning:APP_COLORS.warning,danger:APP_COLORS.danger}}))})}(window,document,window.jQuery),function(e,t,o,a){e.APP_COLORS={primary:"#5d9cec",success:"#27c24c",info:"#23b7e5",warning:"#ff902b",danger:"#f05050",inverse:"#131e26",green:"#37bc9b",pink:"#f532e5",purple:"#7266ba",dark:"#3a3f51",yellow:"#fad732","gray-darker":"#232735","gray-dark":"#3a3f51",gray:"#dde6e9","gray-light":"#e4eaec","gray-lighter":"#edf1f2"},e.APP_MEDIAQUERY={desktopLG:1200,desktop:992,tablet:768,mobile:480}}(window,document,window.jQuery),function(e,t,o,a){o(function(){o.fn.easyPieChart&&o("[data-easypiechart]").each(function(){var e=o(this),t=e.data();e.easyPieChart(t||{})})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o(".flatdoc").each(function(){Flatdoc.run({fetcher:Flatdoc.file("documentation/readme.md"),root:".flatdoc",menu:".flatdoc-menu",title:".flatdoc-title",content:".flatdoc-content"})})})}(window,document,window.jQuery),function(e,t,o,a){"undefined"!=typeof screenfull&&o(function(){function a(e){screenfull.isFullscreen?e.children("em").removeClass("fa-expand").addClass("fa-compress"):e.children("em").removeClass("fa-compress").addClass("fa-expand")}var n=o(t),r=o("[data-toggle-fullscreen]"),i=e.navigator.userAgent;(i.indexOf("MSIE ")>0||i.match(/Trident.*rv\:11\./))&&r.addClass("hide"),r.is(":visible")&&(r.on("click",function(e){e.preventDefault(),screenfull.enabled?(screenfull.toggle(),a(r)):console.log("Fullscreen not enabled")}),screenfull.raw&&screenfull.raw.fullscreenchange&&n.on(screenfull.raw.fullscreenchange,function(){a(r)}))})}(window,document,window.jQuery),function(e,t,o){"use strict";var a=[{featureType:"water",stylers:[{visibility:"on"},{color:"#bdd1f9"}]},{featureType:"all",elementType:"labels.text.fill",stylers:[{color:"#334165"}]},{featureType:"landscape",stylers:[{color:"#e9ebf1"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#c5c6c6"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#fff"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#fff"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#d8dbe0"}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#cfd5e0"}]},{featureType:"administrative",stylers:[{visibility:"on"},{lightness:33}]},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"on"},{lightness:20}]},{featureType:"road",stylers:[{color:"#d8dbe0",lightness:20}]}];if(e.fn.gMap){var n=[];e("[data-gmap]").each(function(){var t=e(this),o=t.data("address")&&t.data("address").split(";"),r=t.data("title")&&t.data("title").split(";"),i=t.data("zoom")||14,s=t.data("maptype")||"ROADMAP",l=[];if(o){for(var c in o)"string"==typeof o[c]&&l.push({address:o[c],html:r&&r[c]||"",popup:!0});var d={controls:{panControl:!0,zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,overviewMapControl:!0},scrollwheel:!1,maptype:s,markers:l,zoom:i},u=t.gMap(d),f=u.data("gMap.reference");n.push(f),void 0!==t.data("styled")&&f.setOptions({styles:a})}})}}(jQuery,window,document),function(e,t,o,a){o(function(){if(o.fn.cropper){var a=o(".img-container > img"),n=o("#dataX"),r=o("#dataY"),i=o("#dataHeight"),s=o("#dataWidth"),l=o("#dataRotate"),c={aspectRatio:16/9,preview:".img-preview",crop:function(e){n.val(Math.round(e.x)),r.val(Math.round(e.y)),i.val(Math.round(e.height)),s.val(Math.round(e.width)),l.val(Math.round(e.rotate))}};a.on({"build.cropper":function(e){console.log(e.type)},"built.cropper":function(e){console.log(e.type)},"dragstart.cropper":function(e){console.log(e.type,e.dragType)},"dragmove.cropper":function(e){console.log(e.type,e.dragType)},"dragend.cropper":function(e){console.log(e.type,e.dragType)},"zoomin.cropper":function(e){console.log(e.type)},"zoomout.cropper":function(e){console.log(e.type)},"change.cropper":function(e){console.log(e.type)}}).cropper(c),o(t.body).on("click","[data-method]",function(){var e,t,n=o(this).data();if(a.data("cropper")&&n.method){if(n=o.extend({},n),void 0!==n.target&&(e=o(n.target),void 0===n.option))try{n.option=JSON.parse(e.val())}catch(e){console.log(e.message)}if(t=a.cropper(n.method,n.option),"getCroppedCanvas"===n.method&&o("#getCroppedCanvasModal").modal().find(".modal-body").html(t),o.isPlainObject(t)&&e)try{e.val(JSON.stringify(t))}catch(e){console.log(e.message)}}}).on("keydown",function(e){if(a.data("cropper"))switch(e.which){case 37:e.preventDefault(),a.cropper("move",-1,0);break;case 38:e.preventDefault(),a.cropper("move",0,-1);break;case 39:e.preventDefault(),a.cropper("move",1,0);break;case 40:e.preventDefault(),a.cropper("move",0,1)}});var d,u=o("#inputImage"),f=e.URL||e.webkitURL;f?u.change(function(){var e,t=this.files;a.data("cropper")&&t&&t.length&&(e=t[0],/^image\/\w+$/.test(e.type)?(d=f.createObjectURL(e),a.one("built.cropper",function(){f.revokeObjectURL(d)}).cropper("reset").cropper("replace",d),u.val("")):alert("Please choose an image file."))}):u.parent().remove(),o(".docs-options :checkbox").on("change",function(){var e=o(this);a.data("cropper")&&(c[e.val()]=e.prop("checked"),a.cropper("destroy").cropper(c))}),o('[data-toggle="tooltip"]').tooltip()}})}(window,document,window.jQuery),function(e,t,o,a){function n(e){var t="autoloaded-stylesheet",a=o("#"+t).attr("id",t+"-old");return o("head").append(o("<link/>").attr({id:t,rel:"stylesheet",href:e})),a.length&&a.remove(),o("#"+t)}o(function(){o("[data-load-css]").on("click",function(e){var t=o(this);t.is("a")&&e.preventDefault();var a=t.data("loadCss");a?n(a)||o.error("Error creating stylesheet link element."):o.error("No stylesheet location defined.")})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){function e(e){o("[data-localize]").localize("site",e)}
	function t(e){
		var t=e.parents(".dropdown-menu");
		t.length&&t.prev("button, a").text(e.text())
	}

	if(o.fn.localize){
		var a=o.localStorage.get("jq-appLang")||"en",n={language:a,pathPrefix:"i18n",callback:function(e,t){o.localStorage.set("jq-appLang",a),t(e)}};e(n),o("[data-set-lang]").on("click",function(){(a=o(this).data("setLang"))&&(n.language=a,e(n),t(o(this)))})}})}(window,document,window.jQuery),function(e,t,o,a){e.defaultColors={markerColor:"#23b7e5",bgColor:"transparent",scaleColors:["#878c9a"],regionFill:"#bbbec6"},e.VectorMap=function(e,t,o){if(e&&e.length){var a=e.data(),n=a.height||"300",r={markerColor:a.markerColor||defaultColors.markerColor,bgColor:a.bgColor||defaultColors.bgColor,scale:a.scale||1,scaleColors:a.scaleColors||defaultColors.scaleColors,regionFill:a.regionFill||defaultColors.regionFill,mapName:a.mapName||"world_mill_en"};e.css("height",n),function(e,t,o,a){e.vectorMap({map:t.mapName,backgroundColor:t.bgColor,zoomMin:1,zoomMax:8,zoomOnScroll:!1,regionStyle:{initial:{fill:t.regionFill,"fill-opacity":1,stroke:"none","stroke-width":1.5,"stroke-opacity":1},hover:{"fill-opacity":.8},selected:{fill:"blue"},selectedHover:{}},focusOn:{x:.4,y:.6,scale:t.scale},markerStyle:{initial:{fill:t.markerColor,stroke:t.markerColor}},onRegionLabelShow:function(e,t,a){o&&o[a]&&t.html(t.html()+": "+o[a]+" visitors")},markers:a,series:{regions:[{values:o,scale:t.scaleColors,normalizeFunction:"polynomial"}]}})}(e,r,t,o)}}}(window,document,window.jQuery),function(e,t,o,a){o(function(){if("undefined"!=typeof Morris){var e=[{y:"2006",a:100,b:90},{y:"2007",a:75,b:65},{y:"2008",a:50,b:40},{y:"2009",a:75,b:65},{y:"2010",a:50,b:40},{y:"2011",a:75,b:65},{y:"2012",a:100,b:90}],t=[{label:"Download Sales",value:12},{label:"In-Store Sales",value:30},{label:"Mail-Order Sales",value:20}];new Morris.Line({element:"morris-line",data:e,xkey:"y",ykeys:["a","b"],labels:["Serie A","Serie B"],lineColors:["#31C0BE","#7a92a3"],resize:!0}),new Morris.Donut({element:"morris-donut",data:t,colors:["#f05050","#fad732","#ff902b"],resize:!0}),new Morris.Bar({element:"morris-bar",data:e,xkey:"y",ykeys:["a","b"],labels:["Series A","Series B"],xLabelMargin:2,barColors:["#23b7e5","#f05050"],resize:!0}),new Morris.Area({element:"morris-area",data:e,xkey:"y",ykeys:["a","b"],labels:["Serie A","Serie B"],lineColors:["#7266ba","#23b7e5"],resize:!0})}})}(window,document,window.jQuery),function(e,t,o,a){o(function(){var e=new n;o("[data-search-open]").on("click",function(e){e.stopPropagation()}).on("click",e.toggle);var a=o("[data-search-dismiss]");o('.navbar-form input[type="text"]').on("click",function(e){e.stopPropagation()}).on("keyup",function(t){27==t.keyCode&&e.dismiss()}),o(t).on("click",e.dismiss),a.on("click",function(e){e.stopPropagation()}).on("click",e.dismiss)});var n=function(){return{toggle:function(){var e=o("form.navbar-form");e.toggleClass("open");var t=e.hasClass("open");e.find("input")[t?"focus":"blur"]()},dismiss:function(){o("form.navbar-form").removeClass("open").find('input[type="text"]').blur()}}}}(window,document,window.jQuery),function(e,t,o){"use strict";function a(t){var o=t.data("message"),a=t.data("options");o||e.error("Notify: No message specified"),e.notify(o,a||{})}e(o);e(function(){e("[data-notify]").each(function(){var t=e(this);void 0!==t.data("onload")&&setTimeout(function(){a(t)},800),t.on("click",function(e){e.preventDefault(),a(t)})})})}(jQuery,window,document),function(e,t,o){var a={},n={},r=function(t){return"string"==e.type(t)&&(t={message:t}),arguments[1]&&(t=e.extend(t,"string"==e.type(arguments[1])?{status:arguments[1]}:arguments[1])),new s(t).show()},i=function(e,t){if(e)for(var o in n)e===n[o].group&&n[o].close(t);else for(var o in n)n[o].close(t)},s=function(t){this.options=e.extend({},s.defaults,t),this.uuid="ID"+(new Date).getTime()+"RAND"+Math.ceil(1e5*Math.random()),this.element=e(['<div class="uk-notify-message alert-dismissable">','<a class="close">&times;</a>',"<div>"+this.options.message+"</div>","</div>"].join("")).data("notifyMessage",this),this.options.status&&(this.element.addClass("alert alert-"+this.options.status),this.currentstatus=this.options.status),this.group=this.options.group,n[this.uuid]=this,a[this.options.pos]||(a[this.options.pos]=e('<div class="uk-notify uk-notify-'+this.options.pos+'"></div>').appendTo("body").on("click",".uk-notify-message",function(){e(this).data("notifyMessage").close()}))};e.extend(s.prototype,{uuid:!1,element:!1,timout:!1,currentstatus:"",group:!1,show:function(){if(!this.element.is(":visible")){var e=this;a[this.options.pos].show().prepend(this.element);var t=parseInt(this.element.css("margin-bottom"),10);return this.element.css({opacity:0,"margin-top":-1*this.element.outerHeight(),"margin-bottom":0}).animate({opacity:1,"margin-top":0,"margin-bottom":t},function(){if(e.options.timeout){var t=function(){e.close()};e.timeout=setTimeout(t,e.options.timeout),e.element.hover(function(){clearTimeout(e.timeout)},function(){e.timeout=setTimeout(t,e.options.timeout)})}}),this}},close:function(e){var t=this,o=function(){t.element.remove(),a[t.options.pos].children().length||a[t.options.pos].hide(),delete n[t.uuid]};this.timeout&&clearTimeout(this.timeout),e?o():this.element.animate({opacity:0,"margin-top":-1*this.element.outerHeight(),"margin-bottom":0},function(){o()})},content:function(e){var t=this.element.find(">div");return e?(t.html(e),this):t.html()},status:function(e){return e?(this.element.removeClass("alert alert-"+this.currentstatus).addClass("alert alert-"+e),this.currentstatus=e,this):this.currentstatus}}),s.defaults={message:"",status:"normal",timeout:5e3,group:null,pos:"top-center"},e.notify=r,e.notify.message=s,e.notify.closeAll=i}(jQuery,window,document),function(e,t,o,a){o(function(){o("[data-now]").each(function(){function e(){var e=moment(new Date).format(a);t.text(e)}var t=o(this),a=t.data("format");e(),setInterval(e,1e3)})})}(window,document,window.jQuery),function(e,t,o){"use strict";var a="panel.removed";e(o).on("click",'[data-tool="panel-dismiss"]',function(){function t(){e.support.animation?n.animo({animation:"bounceOut"},o):o()}function o(){var t=n.parent();e.when(n.trigger(a,[n])).done(function(){n.remove(),t.trigger(a).filter(function(){var t=e(this);return t.is('[class*="col-"]:not(.sortable)')&&0===t.children("*").length}).remove()})}var n=e(this).closest(".panel"),r=new e.Deferred;n.trigger("panel.remove",[n,r]),r.done(t)})}(jQuery,window,document),function(e,t,o){"use strict";function a(e){e.removeClass("fa-plus").addClass("fa-minus")}function n(e){e.removeClass("fa-minus").addClass("fa-plus")}function r(t,o){var a=e.localStorage.get(s);a||(a={}),a[t]=o,e.localStorage.set(s,a)}function i(t){var o=e.localStorage.get(s);if(o)return o[t]||!1}var s="jq-panelState";e('[data-tool="panel-collapse"]').each(function(){var t=e(this),o=t.closest(".panel"),s=o.find(".panel-wrapper"),l={toggle:!1},c=t.children("em"),d=o.attr("id");s.length||(s=o.children(".panel-heading").nextAll().wrapAll("<div/>").parent().addClass("panel-wrapper"),l={}),s.collapse(l).on("hide.bs.collapse",function(){n(c),r(d,"hide"),s.prev(".panel-heading").addClass("panel-heading-collapsed")}).on("show.bs.collapse",function(){a(c),r(d,"show"),s.prev(".panel-heading").removeClass("panel-heading-collapsed")});var u=i(d);u&&(setTimeout(function(){s.collapse(u)},50),r(d,u))}),e(o).on("click",'[data-tool="panel-collapse"]',function(){e(this).closest(".panel").find(".panel-wrapper").collapse("toggle")})}(jQuery,window,document),function(e,t,o){"use strict";function a(){this.removeClass(n)}var n="whirl";e(o).on("click",'[data-tool="panel-refresh"]',function(){var t=e(this),o=t.parents(".panel").eq(0),r=t.data("spinner")||"standard";o.addClass(n+" "+r),o.removeSpinner=a,t.trigger("panel.refresh",[o])})}(jQuery,window,document),function(e,t,o){"use strict";e(function(){var a=e(t).add("body, .wrapper");e("[data-animate]").each(function(){function t(t){!t.hasClass("anim-running")&&e.Utils.isInView(t,{topoffset:n})&&(t.addClass("anim-running"),setTimeout(function(){t.addClass("anim-done").animo({animation:i,duration:.7})},r))}var o=e(this),n=o.data("offset"),r=o.data("delay")||100,i=o.data("play")||"bounce";void 0!==n&&(t(o),a.scroll(function(){t(o)}))}),e(o).on("click","[data-animate]",function(){var t=e(this),o=t.data("target"),a=t.data("play")||"bounce",n=e(o);n&&n.length&&n.animo({animation:a})})})}(jQuery,window,document),function(e,t,o){"use strict";function a(t,o){var a=e.localStorage.get(r);a||(a={}),a[this.id]=e(this).sortable("toArray"),a&&e.localStorage.set(r,a)}function n(){var t=e.localStorage.get(r);if(t){var o=this.id,a=t[o];if(a){var n=e("#"+o);e.each(a,function(t,o){e("#"+o).appendTo(n)})}}}if(e.fn.sortable){var r="jq-portletState";e(function(){e('[data-toggle="portlet"]').sortable({connectWith:'[data-toggle="portlet"]',items:"div.panel",handle:".portlet-handler",opacity:.7,placeholder:"portlet box-placeholder",cancel:".portlet-cancel",forcePlaceholderSize:!0,iframeFix:!1,tolerance:"pointer",helper:"original",revert:200,forceHelperSize:!0,update:a,create:n})})}}(jQuery,window,document),function(e,t,o,a){o(function(){if("undefined"!=typeof Rickshaw){for(var e=[[],[],[]],o=new Rickshaw.Fixtures.RandomData(150),a=0;a<150;a++)o.addData(e);var n=[{color:"#c05020",data:e[0],name:"New York"},{color:"#30c020",data:e[1],name:"London"},{color:"#6060c0",data:e[2],name:"Tokyo"}];new Rickshaw.Graph({element:t.querySelector("#rickshaw1"),series:n,renderer:"area"}).render();new Rickshaw.Graph({element:t.querySelector("#rickshaw2"),renderer:"area",stroke:!0,series:[{data:[{x:0,y:40},{x:1,y:49},{x:2,y:38},{x:3,y:30},{x:4,y:32}],color:"#f05050"},{data:[{x:0,y:40},{x:1,y:49},{x:2,y:38},{x:3,y:30},{x:4,y:32}],color:"#fad732"}]}).render();new Rickshaw.Graph({element:t.querySelector("#rickshaw3"),renderer:"line",series:[{data:[{x:0,y:40},{x:1,y:49},{x:2,y:38},{x:3,y:30},{x:4,y:32}],color:"#7266ba"},{data:[{x:0,y:20},{x:1,y:24},{x:2,y:19},{x:3,y:15},{x:4,y:16}],color:"#23b7e5"}]}).render();new Rickshaw.Graph({element:t.querySelector("#rickshaw4"),renderer:"bar",series:[{data:[{x:0,y:40},{x:1,y:49},{x:2,y:38},{x:3,y:30},{x:4,y:32}],color:"#fad732"},{data:[{x:0,y:20},{x:1,y:24},{x:2,y:19},{x:3,y:15},{x:4,y:16}],color:"#ff902b"}]}).render()}})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o.fn.select2&&(o("#select2-1").select2({theme:"bootstrap"}),o("#select2-2").select2({theme:"bootstrap"}),o("#select2-3").select2({theme:"bootstrap"}),o("#select2-4").select2({placeholder:"Select a state",allowClear:!0,theme:"bootstrap"}))})}(window,document,window.jQuery),function(e,t,o,a){function n(){o("<div/>",{class:"dropdown-backdrop"}).insertAfter(".aside").on("click mouseenter",function(){s()})}function r(e){e.siblings("li").removeClass("open").end().toggleClass("open")}function i(e){s();var t=e.children("ul");if(!t.length)return o();if(e.hasClass("open"))return r(e),o();var a=o(".aside"),n=o(".aside-inner"),i=parseInt(n.css("padding-top"),0)+parseInt(a.css("padding-top"),0),l=t.clone().appendTo(a);r(e);var c=e.position().top+i-g.scrollTop(),u=f.height();return l.addClass("nav-floating").css({position:d()?"fixed":"absolute",top:c,bottom:l.outerHeight(!0)+c>u?0:"auto"}),l.on("mouseleave",function(){r(e),l.remove()}),l}function s(){o(".sidebar-subnav.nav-floating").remove(),o(".dropdown-backdrop").remove(),o(".sidebar li.open").removeClass("open")}function l(){return p.hasClass("touch")}function c(){return h.hasClass("aside-collapsed")||h.hasClass("aside-collapsed-text")}function d(){return h.hasClass("layout-fixed")}function u(){return h.hasClass("aside-hover")}var f,p,h,g,m;o(function(){f=o(e),p=o("html"),h=o("body"),g=o(".sidebar"),m=APP_MEDIAQUERY;var t=g.find(".collapse");t.on("show.bs.collapse",function(e){e.stopPropagation(),0===o(this).parents(".collapse").length&&t.filter(".in").collapse("hide")});var a=o(".sidebar .active").parents("li");u()||a.addClass("active").children(".collapse").collapse("show"),g.find("li > a + ul").on("show.bs.collapse",function(e){u()&&e.preventDefault()});var r=l()?"click":"mouseenter",s=o();g.on(r,".nav > li",function(){(c()||u())&&(s.trigger("mouseleave"),s=i(o(this)),n())}),void 0!==g.data("sidebarAnyclickClose")&&o(".wrapper").on("click.sidebar",function(e){if(h.hasClass("aside-toggled")){var t=o(e.target);t.parents(".aside").length||t.is("#user-block-toggle")||t.parent().is("#user-block-toggle")||h.removeClass("aside-toggled")}})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o("[data-skycon]").each(function(){var e=o(this),t=new Skycons({color:e.data("color")||"white"});e.html('<canvas width="'+e.data("width")+'" height="'+e.data("height")+'"></canvas>'),t.add(e.children()[0],e.data("skycon")),t.play()})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o("[data-scrollable]").each(function(){var e=o(this);e.slimScroll({height:e.data("height")||250})})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){function t(){var t=o(this),a=t.data(),n=a.values&&a.values.split(",");a.type=a.type||"bar",a.disableHiddenCheck=!0,t.sparkline(n,a),a.resize&&o(e).resize(function(){t.sparkline(n,a)})}o("[data-sparkline]").each(t)})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o("#swal-demo1").on("click",function(e){e.preventDefault(),swal("Here's a message!")}),o("#swal-demo2").on("click",function(e){e.preventDefault(),swal("Here's a message!","It's pretty, isn't it?")}),o("#swal-demo3").on("click",function(e){e.preventDefault(),swal("Good job!","You clicked the button!","success")}),o("#swal-demo4").on("click",function(e){e.preventDefault(),swal({title:"Are you sure?",text:"You will not be able to recover this imaginary file!",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Yes, delete it!",closeOnConfirm:!1},function(){swal("Deleted!","Your imaginary file has been deleted.","success")})}),o("#swal-demo5").on("click",function(e){e.preventDefault(),swal({title:"Are you sure?",text:"You will not be able to recover this imaginary file!",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Yes, delete it!",cancelButtonText:"No, cancel plx!",closeOnConfirm:!1,closeOnCancel:!1},function(e){e?swal("Deleted!","Your imaginary file has been deleted.","success"):swal("Cancelled","Your imaginary file is safe :)","error")})})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){o("[data-check-all]").on("change",function(){var e=o(this),t=e.index()+1,a=e.find('input[type="checkbox"]');e.parents("table").find("tbody > tr > td:nth-child("+t+') input[type="checkbox"]').prop("checked",a[0].checked)})})}(window,document,window.jQuery),function(e,t,o,a){o(function(){var t=o("body");toggle=new StateToggler,o("[data-toggle-state]").on("click",function(a){a.stopPropagation();var n=o(this),r=n.data("toggleState"),i=n.data("target"),s=void 0!==n.attr("data-no-persist"),l=i?o(i):t;r&&(l.hasClass(r)?(l.removeClass(r),s||toggle.removeState(r)):(l.addClass(r),s||toggle.addState(r))),o(e).resize()})}),e.StateToggler=function(){var e={hasWord:function(e,t){return new RegExp("(^|\\s)"+t+"(\\s|$)").test(e)},addWord:function(e,t){if(!this.hasWord(e,t))return e+(e?" ":"")+t},removeWord:function(e,t){if(this.hasWord(e,t))return e.replace(new RegExp("(^|\\s)*"+t+"(\\s|$)*","g"),"")}};return{addState:function(t){var a=o.localStorage.get("jq-toggleState");a=a?e.addWord(a,t):t,o.localStorage.set("jq-toggleState",a)},removeState:function(t){var a=o.localStorage.get("jq-toggleState");a&&(a=e.removeWord(a,t),o.localStorage.set("jq-toggleState",a))},restoreState:function(e){var t=o.localStorage.get("jq-toggleState");t&&e.addClass(t)}}}}(window,document,window.jQuery),function(e,t,o,a){o(function(){var e=[];if(o(".tour-step").each(function(){var t=o(this).data();t.element="#"+this.id,e.push(t)}),e.length){var t=new Tour({backdrop:!0,onShown:function(e){o(".wrapper > section").css({position:"static"})},onHide:function(e){o(".wrapper > section").css({position:""})},steps:e});t.init(),o("#start-tour").on("click",function(){t.restart()
})}})}
(window,document,window.jQuery),function(e,t,o,a){
	o(function(){
		var a=o("[data-trigger-resize]"),n=a.data("triggerResize");
		a.on("click",function(){setTimeout(function(){
			var o=t.createEvent("UIEvents");
			o.initUIEvent("resize",!0,!1,e,0),e.dispatchEvent(o)},n||300)})})}

(window,document,window.jQuery),function(e,t,o){
	"use strict";
	var a=e("html"),n=e(t);
	e.support.transition=function(){
		var e=function(){var e,t=o.body||o.documentElement,a=
			{WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};
			for(e in a)if(void 0!==t.style[e])return a[e]}();
				return e&&{end:e}}(),e.support.animation=function(){var e=function(){var e,t=o.body||o.documentElement,a={WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(e in a)if(void 0!==t.style[e])return a[e]}();return e&&{end:e}}(),e.support.requestAnimationFrame=t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.msRequestAnimationFrame||t.oRequestAnimationFrame||function(e){t.setTimeout(e,1e3/60)},e.support.touch="ontouchstart"in t&&navigator.userAgent.toLowerCase().match(/mobile|tablet/)||t.DocumentTouch&&document instanceof t.DocumentTouch||t.navigator.msPointerEnabled&&t.navigator.msMaxTouchPoints>0||t.navigator.pointerEnabled&&t.navigator.maxTouchPoints>0||!1,e.support.mutationobserver=t.MutationObserver||t.WebKitMutationObserver||t.MozMutationObserver||null,e.Utils={},e.Utils.debounce=function(e,t,o){var a;return function(){var n=this,r=arguments,i=function(){a=null,o||e.apply(n,r)},s=o&&!a;clearTimeout(a),a=setTimeout(i,t),s&&e.apply(n,r)}},e.Utils.removeCssRules=function(e){var t,o,a,n,r,i,s,l,c,d;e&&setTimeout(function(){try{for(d=document.styleSheets,n=0,s=d.length;n<s;n++){for(a=d[n],o=[],a.cssRules=a.cssRules,t=r=0,l=a.cssRules.length;r<l;t=++r)a.cssRules[t].type===CSSRule.STYLE_RULE&&e.test(a.cssRules[t].selectorText)&&o.unshift(t);for(i=0,c=o.length;i<c;i++)a.deleteRule(o[i])}}catch(e){}},0)},e.Utils.isInView=function(t,o){var a=e(t);if(!a.is(":visible"))return!1;var r=n.scrollLeft(),i=n.scrollTop(),s=a.offset(),l=s.left,c=s.top;return o=e.extend({topoffset:0,leftoffset:0},o),c+a.height()>=i&&c-o.topoffset<=i+n.height()&&l+a.width()>=r&&l-o.leftoffset<=r+n.width()},e.Utils.options=function(t){if(e.isPlainObject(t))return t;var o=t?t.indexOf("{"):-1,a={};if(-1!=o)try{a=new Function("","var json = "+t.substr(o)+"; return JSON.parse(JSON.stringify(json));")()}catch(e){}return a},e.Utils.events={},e.Utils.events.click=e.support.touch?"tap":"click",e.langdirection="rtl"==a.attr("dir")?"right":"left",e(function(){if(e.support.mutationobserver){new e.support.mutationobserver(e.Utils.debounce(function(t){e(o).trigger("domready")},300)).observe(document.body,{childList:!0,subtree:!0})}}),a.addClass(e.support.touch?"touch":"no-touch")}(jQuery,window,document),function(e,t,o,a){o(function(){})}(window,document,window.jQuery);


function required(control)
{
   valor= "#"+control;
   mensaje = "#required-" + control;
   cadena=$.trim($(valor).val());
  if(cadena=="" || cadena=="0")
  {
    $(mensaje).show();
    $(valor).addClass("form-control parsley-error");
    return false;
  }
  return true;
}

function isNumeric(control)
{
  valor= "#"+control;
  mensaje = "#required-" + control;

  if($.isNumeric($(valor).val()))
  {
    if(parseFloat($(valor).val()) < 0)
    {
      $(mensaje).show();
	  $(valor).addClass("form-control parsley-error");
		return false;
    }
    return true;
  }

  $(mensaje).show();
  $(valor).addClass("form-control parsley-error");
	return false;
}

function selected(control)
{
   valor= "#"+control;
   mensaje = "#required-" + control;

   if ($('select[name="'+ control+'"]').val() == "0")  
  {
    $(mensaje).show();
    $(valor).addClass("form-control parsley-error");
    return false;
  }
  return true;
}

(function(window, document, $, undefined){

  $(function(){

    // FORM EXAMPLE
    // ----------------------------------- 
    var form = $("#example-form");
   
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
        	nombre:  { required: true },
		    paterno: { required: true },
		    materno: { required: true },		   
		    nacimiento: {required: true},
            familiar: { required: true },
            tel_familiar: { required: true },
            diagnostico: { required: true },
             nombre_medico:  { 
             	required: {
                    depends: function(element)
                    {
                      if ($("#ckadd").is(":checked") )
                      return true;
                    return false;
                    }
                 }
            },
            paterno_medico:  { 
             	required: {
                    depends: function(element)
                    {
                      if ($("#ckadd").is(":checked") )
                      return true;
                    return false;
                    }
                 }
            },
            materno_medico:  { 
             	required: {
                    depends: function(element)
                    {
                      if ($("#ckadd").is(":checked") )
                      return true;
                    return false;
                    }
                 }
            },
            telefono_medico:  { 
             	required: {
                    depends: function(element)
                    {
                      if ($("#ckadd").is(":checked") )
                      return true;
                    return false;
                    }
                 }
            },
            medico_tratante:{
	            required: true,
                min:{
                    depends: function(element)
                    {
                    	if ($("#ckadd").is(":checked") )
                           return false;
                        else
                        {
                        	if ($('#medico_tratante option:selected').val() == 0)
                        		return true;
                        }
                     return false;
                    }
                 }
            },
            ingreso: { required: true },
            ubicacion:{
            	required: true,
                min:{
                    depends: function(element)
                    {
                      if ($('#ubicacion').val() == '')
                      return true;
                    return false;
                    }
                 }
             },
        },
        messages: {
        	nombre:  "Nombre es requerido",
		    paterno: "Apellido Paterno es requerido",
		    materno: "Apellido Materno es requerido",		   
		    nacimiento:   "Fecha requerida",
            familiar:     "Nombre de Familiar en caso de emergencia",
            tel_familiar: "Teléfono de Familiar en caso de emergencia",
            diagnostico: "Ingrese motivo de hospitalización",
            ingreso: "Seleccionar fecha de hospitalización",
            ubicacion: "Seleccionar ubicación",
            nombre_medico:  "Nombre es requerido",
		    paterno_medico: "Apellido Paterno es requerido",
		    materno_medico: "Apellido Materno es requerido",	
		    telefono_medico: "Teléfono en caso de emergencia",
		    medico_tratante: "Seleccionar médico",
        }
    });

    form.children("div").steps({
        headerTag: "h4",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {   
        	 form.submit();
        }
    });

    // VERTICAL
    // ----------------------------------- 

    $("#example-vertical").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    });

  });

})(window, document, window.jQuery);