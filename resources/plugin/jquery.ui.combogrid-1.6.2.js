(function(a,b){a.widget("cg.combogrid",{options:{resetButton:false,resetFields:null,searchButton:false,searchIcon:false,okIcon:false,alternate:false,appendTo:"body",autoFocus:false,autoChoose:false,delayChoose:300,delay:300,rows:10,addClass:null,addId:null,minLength:0,munit:"%",position:{my:"left top",at:"left bottom",collision:"none"},url:null,colModel:null,sidx:"",sord:"",datatype:"json",debug:false,i18n:false,draggable:false,rememberDrag:false,replaceNull:false,rowsArray:[10,20,30],showOn:false,width:null},source:null,lastOrdered:"",cssCol:"",pending:0,page:1,rowNumber:0,pos:null,_create:function(){var c=this,e=this.element[0].ownerDocument,d;if(c.options.resetButton){this.element.after('<span class="ui-state-default ui-corner-all '+c.element.attr("id")+' cg-resetButton"><span class="ui-icon ui-icon-circle-close"></span></span>');a("."+c.element.attr("id")+".cg-resetButton").bind("click.combogrid",function(){c.element.val("");c.term=c.element.val();if(c.options.okIcon){a("."+c.element.attr("id")+".ok-icon").remove();a("."+c.element.attr("id")+".notok-icon").remove();if(c.options.resetButton){a("."+c.element.attr("id")+".cg-resetButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{if(c.options.searchButton){a("."+c.element.attr("id")+".cg-searchButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{c.element.after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}}}c.element.trigger("keyup");if(c.options.resetFields!=null){a.each(c.options.resetFields,function(){a(""+this).val("")})}})}if(c.options.searchButton){this.element.after('<span class="ui-state-default ui-corner-all '+c.element.attr("id")+' cg-searchButton"><span class="ui-icon ui-icon-search"></span></span>');a("."+c.element.attr("id")+".cg-searchButton").bind("click.combogrid",function(){c.element.trigger("focus.combogrid");c._search(c.element.val());c.element.trigger("focus.combogrid")})}if(c.options.showOn){this.element.focus(function(){c._search(c.element.val())})}this.element.addClass("ui-autocomplete-input").attr("autocomplete","off").attr({role:"textbox","aria-autocomplete":"list","aria-haspopup":"true"}).bind("keydown.combogrid",function(f){if(c.options.disabled||c.element.attr("readonly")){return}d=false;var g=a.ui.keyCode;switch(f.keyCode){case g.LEFT:a("."+c.element.attr("id")+".cg-keynav-prev").trigger("click.combogrid");break;case g.PAGE_UP:c._move("previousPage",f);break;case g.RIGHT:a("."+c.element.attr("id")+".cg-keynav-next").trigger("click.combogrid");break;case g.PAGE_DOWN:c._move("nextPage",f);break;case g.UP:c._move("previous",f);f.preventDefault();break;case g.DOWN:c._move("next",f);f.preventDefault();break;case g.ENTER:case g.NUMPAD_ENTER:if(c.menucombo.active){d=true;f.preventDefault()}case g.TAB:if(!c.menucombo.active){return}c.menucombo.select(f);break;case g.DELETE:if(c.options.okIcon){a("."+c.element.attr("id")+".ok-icon").remove();a("."+c.element.attr("id")+".notok-icon").remove();if(c.options.resetButton){a("."+c.element.attr("id")+".cg-resetButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{if(c.options.searchButton){a("."+c.element.attr("id")+".cg-searchButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{c.element.after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}}}if(c.options.resetFields!=null){a.each(c.options.resetFields,function(){a(""+this).val("")})}c.element.val("");break;case g.ESCAPE:c.element.val(c.term);c.close(f);a("."+c.element.attr("id")+".ok-icon").remove();a("."+c.element.attr("id")+".notok-icon").remove();if(c.options.okIcon){if(c.options.resetButton){a("."+c.element.attr("id")+".cg-resetButton").after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}else{if(c.options.searchButton){a("."+c.element.attr("id")+".cg-searchButton").after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}else{c.element.after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}}}break;default:if(c.options.okIcon){a("."+c.element.attr("id")+".ok-icon").remove();a("."+c.element.attr("id")+".notok-icon").remove();if(c.options.resetButton){a("."+c.element.attr("id")+".cg-resetButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{if(c.options.searchButton){a("."+c.element.attr("id")+".cg-searchButton").after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}else{c.element.after('<span class="'+c.element.attr("id")+' notok-icon"></span>')}}}clearTimeout(c.searching);c.searching=setTimeout(function(){c.selectedItem=null;c.search(null,f)},c.options.delay);break}}).bind("keypress.combogrid",function(f){if(d){d=false;f.preventDefault()}}).bind("focus.combogrid",function(){if(c.options.disabled){return}c.selectedItem=null;c.previous=c.element.val()}).bind("blur.combogrid",function(f){if(c.options.disabled){return}if(c.options.searchButton){if(c.menucombo.element.is(":visible")){clearTimeout(c.searching);c.closing=setTimeout(function(){c.close(f);c._change(f)},70)}}else{clearTimeout(c.searching);c.closing=setTimeout(function(){c.close(f);c._change(f)},150)}});if(this.options.searchIcon){this.element.addClass("input-bg")}this.options.source=function(g,f){a.ajax({url:c.options.url,dataType:c.options.datatype,data:{sidx:c.options.sidx,page:c.page,sord:c.options.sord,rows:c.options.rows,searchTerm:g.term},success:function(h){if(h.records==0){c.pending--;if(!c.pending){c.element.removeClass("cg-loading");c.close()}}else{if(h.records==1){f(h.records,h.total,a.map(h.rows,function(i){return i}));c.menucombo.activate(a.Event({type:"mouseenter"}),c.menucombo.element.children(".cg-menu-item:first"));if(c.options.autoChoose){setTimeout(function(){c.menucombo._trigger("selected",a.Event({type:"click"}),{item:c.menucombo.active})},c.options.delayChoose)}}else{f(h.records,h.total,a.map(h.rows,function(i){return i}))}}}})};this._initSource();this.response=function(){return c._response.apply(c,arguments)};this.menucombo=a("<div></div>").addClass("cg-autocomplete").appendTo(a(this.options.appendTo||"body",e)[0]).mousedown(function(f){var g=c.menucombo.element[0];if(!a(f.target).closest(".cg-menu-item").length){setTimeout(function(){a(document).one("mousedown",function(h){if(h.target!==c.element[0]&&h.target!==g&&!a.ui.contains(g,h.target)){c.close()}})},1)}setTimeout(function(){clearTimeout(c.closing)},13)}).menucombo({focus:function(g,h){var f=h.item.data("item.combogrid");if(false!==c._trigger("focus",g,{item:f})){if(/^key/.test(g.originalEvent.type)){if(f.value!=b){c.element.val(f.value)}}}},selected:function(h,i){var g=i.item.data("item.combogrid"),f=c.previous;if(c.element[0]!==e.activeElement){if(!c.options.showOn){c.element.focus()}c.previous=f;setTimeout(function(){c.previous=f;c.selectedItem=g},1)}if(false!==c._trigger("select",h,{item:g})){c.element.val(g.value)}c.term=c.element.val();c.close(h);c.selectedItem=g;if(c.options.okIcon){a("."+c.element.attr("id")+".ok-icon").remove();a("."+c.element.attr("id")+".notok-icon").remove();if(c.options.resetButton){a("."+c.element.attr("id")+".cg-resetButton").after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}else{if(c.options.searchButton){a("."+c.element.attr("id")+".cg-searchButton").after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}else{c.element.after('<span class="'+c.element.attr("id")+' ok-icon"></span>')}}}},blur:function(f,g){if(c.menucombo.element.is(":visible")&&(c.element.val()!==c.term)){}}}).zIndex(this.element.zIndex()+1).css({top:0,left:0}).hide().data("menucombo");if(this.options.draggable){this.menucombo.element.draggable({stop:function(f,g){c.pos=g.position}})}if(a.fn.bgiframe){this.menucombo.element.bgiframe()}if(this.options.addClass!=null){this.menucombo.element.addClass(this.options.addClass)}if(this.options.addId!=null){this.menucombo.element.attr("id",this.options.addId)}},destroy:function(){this.element.removeClass("cg-autocomplete-input").removeAttr("autocomplete").removeAttr("role").removeAttr("aria-autocomplete").removeAttr("aria-haspopup");this.menucombo.element.remove();a.Widget.prototype.destroy.call(this)},_setOption:function(c,d){a.Widget.prototype._setOption.apply(this,arguments);if(c==="source"){this._initSource()}if(c==="appendTo"){this.menucombo.element.appendTo(a(d||"body",this.element[0].ownerDocument)[0])}if(c==="disabled"&&d&&this.xhr){this.xhr.abort()}},_initSource:function(){var c=this,e,d;if(a.isArray(this.options.source)){e=this.options.source;this.source=function(g,f){f(a.cg.combogrid.filter(e,g.term))}}else{if(typeof this.options.source==="string"){d=this.options.source;this.source=function(g,f){if(c.xhr){c.xhr.abort()}c.xhr=a.ajax({url:d,data:g,dataType:"json",success:function(i,h,j){if(j===c.xhr){f(i)}c.xhr=null},error:function(h){if(h===c.xhr){f([])}c.xhr=null}})}}else{this.source=this.options.source}}},search:function(d,c){d=d!=null?d:this.element.val();this.page=1;this.rows=10;this.term=this.element.val();if(d.length<this.options.minLength){return this.close(c)}clearTimeout(this.closing);if(this._trigger("search",c)===false){return}if(!this.options.searchButton){return this._search(d)}},_search:function(c){this.pending++;this.element.addClass("cg-loading");this.source({term:c},this.response)},_response:function(c,e,d){if(!this.options.disabled&&d&&d.length){this._suggest(c,e,d);this._trigger("open")}else{this.close()}this.pending--;if(!this.pending){this.element.removeClass("cg-loading")}},close:function(d){var c=this;clearTimeout(this.closing);if(this.menucombo.element.is(":visible")){this.menucombo.element.hide();this.menucombo.deactivate();a("."+c.element.attr("id")+".cg-keynav-next").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-prev").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-last").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-first").unbind("click.combogrid");if(!this.options.debug){this.menucombo.element.empty()}this.options.sidx=c.options.sidx;this.cssCol="";this.lastOrdered="";this.options.rows=10;if(!this.options.rememberDrag){this.pos=null}this._trigger("close",d)}},_change:function(c){if(this.previous!==this.element.val()){this._trigger("change",c,{item:this.selectedItem})}},_normalize:function(c){if(c.length&&c[0].label&&c[0].value){return c}return a.map(c,function(d){if(typeof d==="string"){return{label:d,value:d}}return a.extend({value:a.parseJSON(d)},d)})},_suggest:function(e,g,d){var c=this;var f=this.menucombo.element.empty().zIndex(this.element.zIndex()+1);a("."+c.element.attr("id")+".cg-keynav-next").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-prev").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-last").unbind("click.combogrid");a("."+c.element.attr("id")+".cg-keynav-first").unbind("click.combogrid");a(".cg-colHeader-label").unbind("click.combogrid");this._renderHeader(f,this.options.colModel);this._renderMenu(f,d,this.options.colModel);this._renderPager(f,e,g);this.menucombo.deactivate();this.menucombo.refresh();f.show();this._resizeMenu();if(this.pos==null){f.position(a.extend({of:this.element},this.options.position))}if(this.options.autoFocus){this.menucombo.next(new a.Event("mouseover"))}},_resizeMenu:function(){var c=this.menucombo.element;if(this.options.width!=null){c.css("width",this.options.width)}else{}},_renderHeader:function(e,d){var c=this;div=a('<div id="cg-divHeader" class="ui-state-default">');a.each(d,function(g,f){if(f.width==b){f.width=100/d.length}if(f.align==b){f.align="center"}var h="";if(f.hidden!=b&&f.hidden){h="display:none;";if(f.width!=b){f.width=0}}if(f.columnName==c.cssCol){div.append('<div class="cg-colHeader" style="width:'+f.width+c.options.munit+";"+h+" text-align:"+f.align+'"><label class="cg-colHeader-label" id="'+f.columnName+'">'+c._renderLabel(f.label)+'</label><span class="cg-colHeader '+c.options.sord+'"></span></div>')}else{div.append('<div class="cg-colHeader" style="width:'+f.width+c.options.munit+";"+h+" text-align:"+f.align+'"><label class="cg-colHeader-label" id="'+f.columnName+'">'+c._renderLabel(f.label)+"</label></div>")}});div.append("</div").appendTo(e);if(this.options.draggable){a("#cg-divHeader").css("cursor","move")}a(".cg-colHeader-label").bind("click.combogrid",function(){c.options.sord="";c.cssCol="";value=a(this).attr("id");c.cssCol=value;if(c.lastOrdered==value){c.lastOrdered="";c.options.sord="desc"}else{c.lastOrdered=value;c.options.sord="asc"}c.options.sidx=value;c._search(c.term)})},_renderLabel:function(c){if(this.options.i18n){return a.i18n.prop(c)}else{return c}},_renderMenu:function(f,d,e){var c=this;a.each(d,function(g,h){c._renderItem(f,h,e)})},_renderItem:function(e,f,d){var c=this;this.rowNumber++;div=a("<div class='cg-colItem'>");a.each(d,function(h,g){if(g.width==b){g.width=100/d.length}if(g.align==b){g.align="center"}var i="";if(g.hidden!=b&&g.hidden){i="display:none;"}var j;if(f[g.columnName]!=null&&typeof f[g.columnName]==="object"){subItem=f[g.columnName];j=subItem[g.subName]}else{if(f[g.columnName]==null&&c.options.replaceNull){j=""}else{j=f[g.columnName]}}a("<div style='width:"+g.width+c.options.munit+";"+i+" text-align:"+g.align+"' class='cg-DivItem'>"+j+"</div>").appendTo(div)});div.append("</div>");if(c.options.alternate){if(this.rowNumber%2==0){return a("<div class='cg-comboItem-even'></div>").data("item.combogrid",f).append(div).appendTo(e)}else{return a("<div class='cg-comboItem-odd'></div>").data("item.combogrid",f).append(div).appendTo(e)}}else{return a("<div class='cg-comboItem'></div>").data("item.combogrid",f).append(div).appendTo(e)}},_renderPager:function(f,e,g){var d=this;var c=((d.page*d.options.rows)-d.options.rows)+1;var h=0;if(d.page<g){h=(d.page*d.options.rows)}else{h=e}div=a("<div class='cg-comboButton ui-state-default'>");a("<table cellspacing='0' cellpadding='0' border='0' class='cg-navTable'><tbody><td align='center' style='white-space: pre; width: 264px;' id='cg-keynav-center'><table cellspacing='0' cellpadding='0' border='0' class='cg-pg-table' style='table-layout: auto;'><tbody><tr><td class='cg-pg-button ui-corner-all cg-state-disabled cg-keynav-first "+d.element.attr("id")+"'><span class='ui-icon ui-icon-seek-first'></span></td><td class='cg-pg-button ui-corner-all cg-state-disabled cg-keynav-prev "+d.element.attr("id")+"'><span class='ui-icon ui-icon-seek-prev'></span></td><td style='width: 4px;' class='cg-state-disabled'><span class='ui-separator'></span></td><td dir='ltr' id='cg-navInfo'>"+d._renderPagerPage("page",d.page,g)+"</td><td style='width: 4px;' class='cg-state-disabled'><span class='ui-separator'></span></td><td class='cg-pg-button ui-corner-all cg-keynav-next "+d.element.attr("id")+"'><span class='ui-icon ui-icon-seek-next'></span></td><td class='cg-pg-button ui-corner-all cg-keynav-last "+d.element.attr("id")+"'><span class='ui-icon ui-icon-seek-end'></span></td><td dir='ltr'><select class='"+d.element.attr("id")+" recordXP'></select></td></tr></tbody></table></td><td align='right' id='cg-keynav-right'><div class='ui-paging-info' style='text-align: right;' dir='ltr'>"+d._renderPagerView("recordtext",c,h,e)+"</div></td></tr></tbody></table>").appendTo(div);div.append("</div>");div.appendTo(f);a.each(d.options.rowsArray,function(i,j){a("."+d.element.attr("id")+".recordXP").append("<option value='"+j+"' role='option'>"+j+"</option>")});a("."+d.element.attr("id")+".recordXP").val(d.options.rows);if(d.page>1){a("."+d.element.attr("id")+".cg-keynav-first").removeClass("cg-state-disabled");a("."+d.element.attr("id")+".cg-keynav-prev").removeClass("cg-state-disabled")}else{a("."+d.element.attr("id")+".cg-keynav-first").addClass("cg-state-disabled");a("."+d.element.attr("id")+".cg-keynav-prev").addClass("cg-state-disabled")}if(d.page==g){a("."+d.element.attr("id")+".cg-keynav-next").addClass("cg-state-disabled");a("."+d.element.attr("id")+".cg-keynav-last").addClass("cg-state-disabled")}a("."+d.element.attr("id")+".cg-keynav-next").bind("click.combogrid",function(){if(d.page<g){d.page++;d._search(d.term)}});a("."+d.element.attr("id")+".cg-keynav-prev").bind("click.combogrid",function(){if(d.page>1){d.page--;d._search(d.term)}});a("."+d.element.attr("id")+".cg-keynav-last").bind("click.combogrid",function(){if(g>1&&d.page<g){d.page=g;d._search(d.term)}});a("."+d.element.attr("id")+".cg-keynav-first").bind("click.combogrid",function(){if(g>1&&d.page>1){d.page=1;d._search(d.term)}});a("."+d.element.attr("id")+".currentPage").keypress(function(j){var i=j.charCode?j.charCode:j.keyCode?j.keyCode:0;if(i==13){if(!isNaN(a(this).val())&&a(this).val()!=0){if(a(this).val()>g){d.page=g}else{d.page=a(this).val()}d._search(d.term)}}});a("."+d.element.attr("id")+".recordXP").bind("change",function(){d.options.rows=this.value;d.page=1;d._search(d.term)});return div},_renderPagerPage:function(d,f,e){var c=this;if(this.options.i18n){return a.i18n.prop("page")+' <input type="text" size="1" class="'+c.element.attr("id")+' currentPage" value="'+f+'"></input> '+a.i18n.prop("of")+" "+e}else{return'Page <input type="text" size="1" class="'+c.element.attr("id")+' currentPage" value="'+f+'"></input> of '+e}},_renderPagerView:function(e,d,f,c){if(this.options.i18n){return a.i18n.prop(e,d,f,c)}else{return"View "+d+" - "+f+" of "+c}},_move:function(d,c){if(!this.menucombo.element.is(":visible")){this.search(null,c);return}if(this.menucombo.first()&&/^previous/.test(d)||this.menucombo.last()&&/^next/.test(d)){this.element.val(this.term);this.menucombo.deactivate();return}this.menucombo[d](c)},widget:function(){return this.menucombo.element}});a.extend(a.cg.combogrid,{escapeRegex:function(c){return c.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")},filter:function(e,c){var d=new RegExp(a.cg.combogrid.escapeRegex(c),"i");return a.grep(e,function(f){return d.test(f.label||f.value||f)})}})}(jQuery));(function(a){a.widget("cg.menucombo",{_create:function(){var b=this;this.element.addClass("cg-menu ui-widget ui-widget-content ui-corner-all combogrid").attr({role:"listbox","aria-activedescendant":"ui-active-menuitem"}).click(function(c){if(!a(c.target).closest(".cg-menu-item div").length){return}c.preventDefault();b.select(c)});this.refresh()},refresh:function(){var c=this;var b=this.element.children("div:not(.cg-menu-item):not(#cg-divHeader):not(.cg-comboButton):has(div)").addClass("cg-menu-item").attr("role","menuitem");b.children("div").addClass("ui-corner-all").attr("tabindex",-1).mouseenter(function(d){c.activate(d,a(this).parent())}).mouseleave(function(){c.deactivate()})},activate:function(e,d){this.deactivate();if(this.hasScroll()){var f=d.offset().top-this.element.offset().top,b=this.element.attr("scrollTop"),c=this.element.height();if(f<0){this.element.attr("scrollTop",b+f)}else{if(f>=c){this.element.attr("scrollTop",b+f-c+d.height())}}}this.active=d.eq(0).addClass("ui-state-hover").attr("id","ui-active-menuitem").end();this._trigger("focus",e,{item:d})},deactivate:function(){if(!this.active){return}this.active.removeClass("ui-state-hover").removeAttr("id");this._trigger("blur");this.active=null},next:function(b){this.move("next",".cg-menu-item:first",b)},previous:function(b){this.move("prev",".cg-menu-item:last",b)},first:function(){return this.active&&!this.active.prevAll(".cg-menu-item").length},last:function(){return this.active&&!this.active.nextAll(".cg-menu-item").length},move:function(e,d,c){if(!this.active){this.activate(c,this.element.children(d));return}var b=this.active[e+"All"](".cg-menu-item").eq(0);if(b.length){this.activate(c,b)}else{this.activate(c,this.element.children(d))}},nextPage:function(d){if(this.hasScroll()){if(!this.active||this.last()){this.activate(d,this.element.children(".cg-menu-item:first"));return}var e=this.active.offset().top,c=this.element.height(),b=this.element.children(".cg-menu-item").filter(function(){var f=a(this).offset().top-e-c+a(this).height();return f<10&&f>-10});if(!b.length){b=this.element.children(".cg-menu-item:last")}this.activate(d,b)}else{this.activate(d,this.element.children(".cg-menu-item").filter(!this.active||this.last()?":first":":last"))}},previousPage:function(c){if(this.hasScroll()){if(!this.active||this.first()){this.activate(c,this.element.children(".cg-menu-item:last"));return}var d=this.active.offset().top,b=this.element.height();result=this.element.children(".cg-menu-item").filter(function(){var e=a(this).offset().top-d+b-a(this).height();return e<10&&e>-10});if(!result.length){result=this.element.children(".cg-menu-item:first")}this.activate(c,result)}else{this.activate(c,this.element.children(".cg-menu-item").filter(!this.active||this.first()?":last":":first"))}},hasScroll:function(){return this.element.height()<this.element.attr("scrollHeight")},select:function(b){this._trigger("selected",b,{item:this.active})}})}(jQuery));