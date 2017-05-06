$(document).ready(function(){

init();

});


function init(){

App_.init();

}

var Globals={


PointToCircleElement:".point-to-circle-btn",
AddCircleButton:".add-circle",
PointyObject:false,
CircleDataContainerElement:"#app-circle-data-container",
AppCircle:".app-circle",
CIDAttribute:"cid",
PostOptionWrap:".post-option-bar-wrap",
PostImageNameField:"#post-img-file-name",
AddPostContainer:"add-post-content-wrap",
PostOptionsContainer:".post-options-wrap",
CirclePostWrap:".circle-post-wrap",
CircleImageNameField:"#circle-image-name",
PostFeedCoulmn:	".post-feed-coulmn",
CurrentCircleId:0,
PostsGridContainer:".posts-grid-container",
NotificationsCountClass:".notifications-count",
CircleDataWrap:".circle-data-wrap",
AppActionAttr:"app-action",
InviteElement:".single-invite",
NotificationElement:".single-notification",
SignUpSuccessMessage:"Congratulations!! You are successfully registered.<br/> Please continue to site.",
InvalidImageMessage:"The file you are uploading does not seem to be a valid image. Please upload a valid image file with JPG, PNG or GIF extension.",
ProfilePageUserPic:"#profile-page-user-pic",
UIDAttribute:"uid",
TopSearchField:"#top-search-field",
ItemTypeAttribute:"item-type",
TypeUser:"user",
TypeCircle:"circle",
TypePost:"post",
PreservedSliderInstance:false,
UserCirclesContainer:".user-circles-container",
DefaultCircleShown:false,
SingleCommentWrap:".single-comment-wrap",
FileUploadXHRObject:false,
MobileExceptionAttribute:"action-mobile-exception",
PostIdAttribute:"post-id",
TriggererAllNotification:".c-notification-all",
RemoveAllContent:"<a href='javascript:void(0)''  title='Mark all as Read' class='action-btn br-50 c-green small c-notification-all'><i class='md md-check'></i></a>",

GetSwalConfig:function(title_,text_,type_,btn_text){

var title_=title_?title_:"Are you Sure?",
    text_=text_?text_:"You will not be able to recover this!",
    type_=type_?type_:"warning",
    btn_text=btn_text?btn_text:"Yes, delete it!";


	return {   
                    title: title_,   
                    text: text_,   
                    type: type_,   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: btn_text,   
                    closeOnConfirm: false 
                }
},

GetCircleDataContainer:function(){

	var container=$(this.CircleDataContainerElement);

	if(container.length){

		return container;

	}

	return false;
},

PointerOrigin:".pointer-origin",

GetCirclesContainerWidth:function(){

var container=$(this.UserCirclesContainer);

return container.length?container.width():0;

},

GetAppMeta:function(){

	return Helpers.GetMetaData("app_meta");
},

IsLoggedIn:function(){

var meta_=GetResponse.Get(this.GetAppMeta());

return meta_.logged_in;

},

};


var SharePost={

	Triggerer:".share-post-btn",
	ShareWidgetContainer:"share-post-widget-wrap",
	ModuleName:"Share This Post",

	Init:function(){

		var this_=this;

		$(document).on("click",this.Triggerer,function(e){

			var post_id=$(this).attr(Globals.PostIdAttribute);

			ModalAlert.SetupModal("<div class='"+this_.ShareWidgetContainer+"'></div>",this_.ModuleName);

			var elem_=$("."+this_.ShareWidgetContainer);

			if(elem_.length){

				Preloaders.PutPreloader(elem_);

				$.post(Helpers.AjaxURL("PostSocialSharing"),{post_id:post_id},function(d){

					Preloaders.RemovePreloader(elem_);

					var d_=GetResponse.Get(d);

					if(d_)

					this_.AfterResponse(d_,elem_);


				})
			}


		});
	},


	AfterResponse:function(d_,container_){

		if(d_.status){

			container_.html(d_.data);

		}

		else {

			AppNotifications.PutNoti(this.ModuleName,d_.message,"danger");
		}

	},
};

var ReadMoreText={

TriggerElem:".read-more-btn",

Init:function(){

$(document).on("click",this.TriggerElem,function(e){

	var  $this=$(this),  
	rest_text=$this.next();

	if(rest_text.length){
	
	var text_=rest_text.html();

	$this.replaceWith(Helpers.Nl2Br(text_));

	$this.remove();rest_text.remove();

	SetPostsGrid.Init();
	
	}


});

}

};


var JoinCircle={

JoinButton:".join-circle-btn",
ModuleName:"Join Circle",

Init:function(){

var this_=this;

$(document).on("click",this.JoinButton,function(e){

	if(!AccessControlCheck.Init("Please log in to be able to join this Circle."))return false;

	var $this=$(this),
	par_=$this.parents("[item-type='circle']:first");

if(par_.length){

var cid_=par_.attr(Globals.CIDAttribute),
    btn_text=$(this).html();

Preloaders.PutPreloader($this," ");

$.post(Helpers.AjaxURL("JoinCircle"),{cid:cid_,container_width:Globals.GetCirclesContainerWidth()},function(d){

Preloaders.RemovePreloader($this,btn_text);

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse(d_,$this);

}

});

}

});

},


AfterResponse:function(d_,btn){

if(d_.status){

btn.parents("div:first").html("<button class=' cursor-default c-green'><i class='md md-check'></i> Joined</button>");

AppNotifications.PutNoti(d_.message,this.ModuleName,"success");

PushCircle.init(d_.data);

CirclesBar.LoadBar();



}

else {

AppNotifications.PutNoti(d_.message,this.ModuleName,"danger");

}


},

};


var EditComment = {

    SingleCommentWrap:Globals.SingleCommentWrap,
    EditCommentWrap:".edit-comment-wrap",
    CancelButton:".edit-comment-cancel",
    EditCommentForm:".edit-comment-form",
    CommentField:".edit-comment-text",
    SubmitButton:".edit-comment-submit",
    ModuleName:"Edit Comment",
    CommentAttribute:"comment-id",
    CommentDiv:".comment-div",
    EditCommentText:".edit-comment-text",

   
    GetParent:function(elem){

        return elem.parents(this.SingleCommentWrap+":first");
    },

    Init:function(){

        this.CancelEdit();
        this.HandleFormSubmission();

    },


    HandleFormSubmission:function(){

        var this_=this;

        $(document).on("submit",this.EditCommentForm,function(e){

            e.preventDefault();

            var $this=$(this),
            comment_field=$this.find(this_.CommentField),
            comment_=$.trim(comment_field.val()),
            btn_=$this.find(this_.SubmitButton),
            comment_id=$this.attr(this_.CommentAttribute);

            if(!comment_.length){

                comment_field.focus();
                return;
            }

            Preloaders.PutPreloader(btn_);

            $.post(Helpers.AjaxURL("EditComment"),{comment:comment_,comment_id:comment_id},function(d){

                Preloaders.RemovePreloader(btn_);

                var d_=GetResponse.Get(d);

                if(d_){

                    this_.AfterResponse(d_,btn_);
                }
            });


        });
    },

    AfterResponse:function(d_,btn_){

        if(d_.status){

        AppNotifications.PutNoti(d_.message,this.ModuleName,"success");

        var par_=this.GetParent(btn_);
       
        par_.find(this.CommentDiv).html(Helpers.Nl2Br(d_.data.comment));

        this.ShowEditText(par_);

        }

        else {

            AppNotifications.PutNoti(d_.message,this.ModuleName,"danger");
        }
    },
   

    ShowEditText:function(par_){

        par_.find(this.CommentDiv).show("fast",function(){

        	SetPostsGrid.Init();
        });

        par_.find(this.EditCommentWrap).addClass("none");



    },

    HideEditText:function(par_){

        if(par_.length){

                par_.find(this.EditCommentWrap).removeClass("none");

                par_.find(this.CommentDiv).hide("fast",function(){

                	SetPostsGrid.Init();
                });

                Helpers.SetCaretAtEnd(par_.find(this.EditCommentText));
   
            }

    },

    EditComment:function(ele){

        var par_=this.GetParent(ele);

        ele.closest(".dropdown").removeClass("open");

        this.HideEditText(par_);   
       

    },


    CancelEdit:function(){

            var this_=this;

            $(document).on("click",this.CancelButton,function(e){

                var par_=this_.GetParent($(this));

                if(par_.length){

                    this_.ShowEditText(par_);
                }

            });

    },
   
};


var AppTour={

	TourContainer:"app-tour-container",

	Init:function(){

	ModalAlert.SetupModal("<div class='"+this.TourContainer+"'></div>","Getting Started",true);	

	var container_=$("."+this.TourContainer),
	    this_=this;

	if(container_.length){

		Preloaders.PutPreloader(container_);

		$.post(Helpers.AjaxURL("GetTourWizard"),{flag:true},function(d){

			Preloaders.RemovePreloader(container_);

			var d_=GetResponse.Get(d);

			if(d_){

				this_.AfterResponse(d_,container_);
			}
		});
	}

	},

	AfterResponse:function(d_,container_){

		if(d_.status){

			container_.html(d_.data);

			  	$('.form-wizard-basic').bootstrapWizard({
    	    	tabClass: 'fw-nav',
    			});

		}

	},
};




var FormValidate={


ErrorClass:"has-error",

Init:function(form_){

	var this_=this,
		error_count=0;

	if(!Helpers.AttributeSupported("required") || isMobile.iOS() ){

		form_.find('[required]').each(function(){

			var parent_div=$(this).parents("div:first");

			if(!$.trim($(this).val()) || ($(this).attr("type")=="checkbox" &&  !$(this).is(":checked")) || ( $(this).attr("type")=="email" && !Helpers.ValidateEmail($.trim($(this).val())))){

			parent_div.addClass(this_.ErrorClass);

			error_count++;

			}

			else{

				parent_div.removeClass(this_.ErrorClass);
			}


		});


		return error_count?false:true;

	}


	return true;
},


};


var CSDefaultCircle={

	Container:".cs-default-circle-wrap",
	CheckBox:".cs-default-circle-checkbox",
	ButtonElement:".make-circle-default-btn",
	ModuleName:"Circle Settings",
	DefaultCIDAttribute:"default-cid",

	Init:function(){

		var this_=this;

		$(document).on("click",this.ButtonElement,function(){

			var $this=$(this),
			container_=$this.parents(this_.Container+":first"),	
			    cid=$this.attr(Globals.CIDAttribute),
			    default_=container_.find(this_.CheckBox).is(":checked")?"1":0;

			    Preloaders.PutPreloader($this);

			    $.post(Helpers.AjaxURL("DefaultCircle"),{cid:cid,default_:default_},function(d){

			    	Preloaders.RemovePreloader($this);

			    	var d_=GetResponse.Get(d);

			    	if(d_){

			    	this_.AfterResponse(d_);	

			    	}
			    })


			

		});
	},


	AfterResponse:function(d_){


		if(d_.status){

		AppNotifications.PutNoti(d_.message,this.ModuleName,"success");	

		ModalAlert.CloseAll();

		}


		else {

		AppNotifications.PutNoti(d_.message,this.ModuleName,"error");	

		}

	},


	AutoLoadDefaultCircle:function(){

		var container_=$(Globals.UserCirclesContainer);

		if(container_.length){
	
		if(Globals.CurrentCircleId){
	
		LoadCircleData.MakeCircleActive(Globals.CurrentCircleId);
	
		}

		else{
	
		var cid=Helpers.HasAttribute(container_, this.DefaultCIDAttribute)?parseInt(container_.attr(this.DefaultCIDAttribute)):0;
		
		if(cid){

		LoadCircleData.LoadData(cid);

		}		

	
		}
		
	
		}


	},
};


var TopSearch={

	FormElement:".top-search-form",
	InputField:Globals.TopSearchField,
	ModuleName:"Search",

	Init:function(){

		var this_=this;

		$(document).on("submit",this.FormElement,function(e){

			if(!$.trim($(this_.InputField).val())){

				e.preventDefault();

				ModalAlert.CloseAll();

				ModalAlert.Error("Please enter a keyword.",this_.ModuleName);
			}


		});


	},
};


var ContactUs={

	ContactForm:".contact-us-form",
	NameField:".contact-name",
	EmailField:".contact-email",
	MessageField:".contact-message",
	ButtonElem:".contact-submit",

	Init:function(){

		var this_=this;

		$(document).on("submit",this.ContactForm,function(e){

			e.preventDefault();

			if(!FormValidate.Init($(this))){

				return;
			}

			var $this=$(this),
				name_field=$this.find(this_.NameField),
				email_field=$this.find(this_.EmailField),
				message_field=$this.find(this_.MessageField),
				btn_elm=$this.find(this_.ButtonElem);

				Preloaders.PutPreloader(btn_elm);

				$.post(Helpers.AjaxURL("contact"),{

					name:$.trim(name_field.val()),
					email:$.trim(email_field.val()),
					message:$.trim(message_field.val()),


				},function(d){

				Preloaders.RemovePreloader(btn_elm);
				
				var d_=GetResponse.Get(d);

				if(d_){

					this_.AfterResponse($this,d_);
				}	

				});





		});
	},

	AfterResponse:function(form_,d_){

	if(d_.status){

	CommonComponents.CleanForm(form_);

	AlertMessage.PutBox(form_,'<i class="glyphicon glyphicon-send"></i>'+d_.message,"success");	

	}	


	else {

	AlertMessage.PutBox(form_,'Error: '+d_.message,"danger");	
	

	}

	},
};

var UnJoinCircle={

	TriggerElem:".un-join-circle-trigger",
	WrapperElement:".unjoin-circle-wrap",

	Init:function(){

		var this_=this;

		$(document).on("click",this_.TriggerElem,function(e){

			var $this=$(this);

			swal(Globals.GetSwalConfig(false,"You won't be receiving updates from this circle!",false,"Yes, Un-Join!"), function(){   
                	swal.close();
                    this_.UnJoinInit($this); 
                });

		});
	},


	UnJoinInit:function(btn_){

	var cid_=btn_.attr(Globals.CIDAttribute),
		this_=this;

	Preloaders.PutPreloader(btn_);

	$.post(Helpers.AjaxURL("Unjoin"),{cid:cid_},function(d){

	Preloaders.RemovePreloader(btn_);

	var d_=GetResponse.Get(d);

	if(d_){

	this_.AfterResponse(d_,cid_);	

	}			

	});	

	},

	AfterResponse:function(d_,cid_){

	if(d_.status){

	ModalAlert.CloseAll();

	AppNotifications.PutNoti(d_.message,"Circle","success");

	this.RemoveCircle(cid_);	
	
	}	

	else {


		AppNotifications.PutNoti(d_.message,"Circle","danger");
	}

	},


	RemoveCircle:function(cid_){

	CirclesSlider.RemoveCircle(cid_);
	
	CirclesBar.LoadBar();

	if(cid_==Globals.CurrentCircleId){

	var container_=$(Globals.CircleDataContainerElement);
	
	if(container_.length){

		container_.html("");
	}	

	}


	},
};

var CircleSettings={

PageWrap:".sc-page-wrap",
ElemClass:"circles-settings-wrap",
RemoveCircleElm:".remove-circle-img",
CircleImageWrap:".circle-image-outer-wrap",
CircleImageDiv:".circle-image-div",
UploadImageWrap:".upload-circle-img-wrap",
CircleImageFile:".cs-file-field",
TriggerFilePopup:".cs-trigger-file-popup",
UpdateCircleForm:".cs-update-circle-form",
UpdateCircleSubmit:".cs-update-circle-submit",
UpdateCircleTitle:".cs-update-title-field",
UpdateCircleFileName:".cs-circle-file-name",
UpdateCircleVisibilityElem:".c-visibility",

Init:function(){

	this.RemoveImageInit();
	this.UploadImageInit();
	this.UpdateInit();
	UnJoinCircle.Init();
},

UpdateInit:function(){

var this_=this;

$(document).on("submit",this.UpdateCircleForm,function(e){

	e.preventDefault();

	var $this=$(this),
		btn_=$this.find(this_.UpdateCircleSubmit),
		title_f=$this.find(this_.UpdateCircleTitle),
		title_=$.trim(title_f.val()),
		image_name=$.trim($this.find(this_.UpdateCircleFileName).val()),
		cid_=btn_.attr(Globals.CIDAttribute),
		privacy=$this.find(this_.UpdateCircleVisibilityElem).val();


	if(!title_.length){

	AlertMessage.PutBox($this,"Please enter the title","danger");

	title_f.focus();
	
	return;	


	}	

	if(btn_.length){

		Preloaders.PutPreloader(btn_);

		$.post(Helpers.AjaxURL("UpdateCircle"),{cid:cid_,title:title_,circle_image:image_name,privacy:privacy},function(d){

		Preloaders.RemovePreloader(btn_);

		var d_=GetResponse.Get(d);

		if(d_){

			this_.AfterUpdateResponse(cid_,d_);
		}


		});
	}

});

},

AfterUpdateResponse:function(cid_,d_){

	if(d_.status){

		CirclesBar.LoadBar();
	
		var circle_=LoadCircleData.CircleElementById(cid_);

		if(circle_){

			circle_.replaceWith($(d_.data));

			PushCircle.CircleEffect(LoadCircleData.CircleElementById(cid_));

		}

		AppNotifications.PutNoti(d_.message,"Circle","success");

		ModalAlert.CloseAll();


	}

	else {

		AppNotifications.PutNoti(d_.message,"Circle","danger");

	}
},


RemoveImageTrigger:function(elem){

ModalAlert.SetupModal(this.GetContent(),"Circle Settings");

var container_=$("."+this.ElemClass),
    cid_=elem.attr(Globals.CIDAttribute);

if(container_.length){

Preloaders.PutPreloader(container_);

$.post(Helpers.AjaxURL("CircleSettings"),{cid:cid_},function(d){

Preloaders.PutPreloader(container_);

var d_=GetResponse.Get(d);

if(d_ && d_.status){

container_.html(d_.data);

AppComponents.CollapseInit();

AppComponents.SelectPickerInit();


}

});

}

},

GetContent:function(){

return "<div class='"+this.ElemClass+"'></div>";

},

UploadImageInit:function(){

	var this_=this;

	$(document).on("change",this_.CircleImageFile,function(e){

	var $this=$(this),
		file_=AppComponents.GetValidImageFile($this);

	if(file_){

	Promises.UploadCircleImage($this).done(function(d){

				var file_name_field_=this_.GetFileNameField($this);

				if(file_name_field_.length && d.data.image.length){

					file_name_field_.val(d.data.image);
				}
			});

	}

	
	});
},


GetFileNameField:function(child_elem_){

	return child_elem_.parents("form:first").find(this.UpdateCircleFileName);
},


RemoveImageInit:function(){

var this_=this;

$(document).on("click",this_.RemoveCircleElm,function(e){

var par_=$(this).parents(this_.CircleImageWrap),
	file_name_field=this_.GetFileNameField($(this));

if(par_.length){

	par_.hide(100,function(){

		$(this_.UploadImageWrap).removeClass("none");

		if(file_name_field.length)file_name_field.val("");
	});
}

});

}


};


var CirclesBar={

	ItemElem:".circle-bar-circle-item",
	SearchField:".cs-search-field",
	Container:"#chat",
	TitleContainer:".lv-title",
	CirclesBarContainer:"#circles-bar-container",

	Init:function(){

	var this_=this;

	this.LoadBar();
	this.SearchInit();

	$(document).on("click",this.ItemElem,function(e){

		e.preventDefault();

		var cid_=$(this).attr(Globals.CIDAttribute),
			c_url=$(this).attr("circle-url");

		if(cid_ && $(Globals.CircleDataContainerElement).length){

			this_.MakeActive($(this));

			LoadCircleData.LoadData(cid_);
			
		}

		else {

			window.location=c_url;
		}
	});	


	},

	FixSideBar:function(){

	var id_="#menu-trigger",
	    elm_=$(id_);
	
	if(elm_.length && elm_.hasClass("open")){
	
	elm_.click();
	
	}
	
	},

	MakeCircleActive:function(cid){

	var elem_=this.GetCircleById(cid);

	if(elem_.length)this.MakeActive(elem_);
	
	},
	

	MakeActive:function(elem_){

		$(this.ItemElem).removeClass("active");

		elem_.addClass("active");

	},

	GetCircleById:function(cid){

	return $(this.ItemElem+"["+Globals.CIDAttribute+"="+cid+"]");
	
	},

	SearchInit:function(){

		var this_=this;

		$(document).on("keyup",this.SearchField,function(){

		var par_=$(this_.Container);

		if(par_.length){

			var container_=par_.find(".tab-pane.active"),
				item_=container_.find(this_.ItemElem),
				val_=$.trim($(this).val());

				if(item_.length){

					item_.hide();

					item_.each(function(){

					var content_=$(this).find(this_.TitleContainer).text();

					if(content_.toLowerCase().indexOf(val_.toLowerCase())!=-1) $(this).show();

					});	

				}
		}	

		});
	},



	LoadBar:function(){
	
	var container_=$(this.CirclesBarContainer);

	if(container_.length){
	
	Preloaders.PutPreloader(container_);

	$.post(Helpers.AjaxURL("GetCirclesBar"),{flag:true},function(d){
	
	Preloaders.RemovePreloader(container_);
	
	var d_=GetResponse.Get(d);

	if(d_ && d_.status){
	
	container_.html(d_.data);
	
	}	
	
	});
	
	}
	
	
	},


	GetCids:function(){

	var cids=new Array(),
	    sb_circles=$(this.ItemElem);

	if(sb_circles.length){

	sb_circles.each(function(){

	if(Helpers.HasAttribute($(this),Globals.CIDAttribute)){

	cids.push($(this).attr(Globals.CIDAttribute));
	
	}
	
	});
	
	}
	
	return cids;	

	},

	UpdateCircleNewPostsCount:function(new_posts){

	for(i in new_posts){

	this.UpdatePostCount(new_posts[i].cid,new_posts[i].new_posts);

	CirclesSlider.UpdatePostCount(new_posts[i].cid,new_posts[i].new_posts);
	
	}

	},

	
	UpdatePostCount:function(cid,count_){

	var cb_circle_elem=this.GetCircleById(cid),
	counter_=cb_circle_elem.find(".tmn-counts");

	if(counter_.length){

	if(count_ && cid!=Globals.CurrentCircleId){

	counter_.html("+"+count_);

	Helpers.Show(counter_);
	
	}

	else {

	counter_.html("");

	Helpers.Hide(counter_);
	
	}
	
	}
	
	},
	
	
	
};


var ScrollToTop={

	TopMargin:200,
	Element:"scroll-up",

   Init:function(){

   	var this_=this;

   	this.SetUpElement();
   	this.ToTopInit();

   	$(window).scroll(function(){
				if ($(this).scrollTop() > this_.TopMargin) {
					$('.'+this_.Element).fadeIn();
				} else {
					$('.'+this_.Element).fadeOut();
				}
			}); 
			
			

   },

   SetUpElement:function(){

   	var elem_=$("."+this.Element);

   	if(!elem_.length){

   		$('body').append("<a title='Go to top' style='display:none' class='pointer bgm-cyan c-white center "+this.Element+"'><i class='md-keyboard-arrow-up'></i></a>");

   	}

   },

   ToTopInit:function(){

   	$(document).on("click","."+this.Element,function(){
				$("html, body").animate({ scrollTop: 0 },(isMobile.any()?0:600));
				return false;
			});
   },

};


var Search={

	SearchResultsContainer:".search-results-container",
	SearchContainer:".search-page-wrap .tab-pane",
	SearchItems:".widget-item",
	SearchPageField:"#sp-serach-field",
	UsersOffset:0,
	PostsOffset:0,
	CirclesOffset:0,
	HitServer:true,
	SearchPageTab:".search-page-tab",

	Init:function(){

		this.SetupGrid();	
		this.AutoLoadInit();
		this.RefreshGridOnTabClick();

	},


	RefreshGridOnTabClick:function(){

	var this_=this;

	$(document).on("shown.bs.tab", this.SearchPageTab, function (e) {

			this_.SetupGrid();	

	});


	},

	GetContainer:function(active_tab){

		return $(this.SearchContainer+(active_tab?".active":"")+" "+this.SearchResultsContainer);
		
	},

	SetupGrid:function(){

	var container_=this.GetContainer(),
		this_=this;

	if(container_.length){

		container_.each(function(){

			if($(this).find(this_.SearchItems).length){

			Grid.Init($(this),this_.SearchItems);

			}

		});
	}




	},

	AutoLoadInit:function(){

	var this_=this,
	container_=this.GetContainer();


	if(container_.length){

		container_.each(function(){

			var last_item=$(this).find(this_.SearchItems+":last");

			if(last_item.length){

				this_.SetUpAutoLoad(last_item);
			}


		});
	}
	

	},



	SetUpAutoLoad:function(last_item){

	var this_=this;

	if(last_item.length){
	var waypoint = new Waypoint({
  	element: last_item[0],
  	offset:'50%',
  	handler: function(direction) {

  	if(direction=='down' && this_.HitServer && last_item.is(":visible")){

  		this_.HitServer=false;

  		$.post(Helpers.AjaxURL("Search"),this_.GetParameters(last_item),function(d){

  		this_.HitServer=true;	

  		var d_=GetResponse.Get(d);

  		if(d_){

  			waypoint.destroy();
  			this_.AfterResponse(d_,last_item);
  		}


  		});
  	}
    
  }
})

}

},




	AfterResponse:function(d_,elem_){

		if(d_.status && $.trim(d_.data).length){

		var par_=elem_.parents(this.SearchResultsContainer+":first"),
			this_=this;
		
		if(par_.length){

			par_.append(d_.data);

			this.SetupGrid();
			
			setTimeout(function(){

			this_.AutoLoadInit();
	
			},500);					

		}	

		}

		else {

			AppNotifications.PutNoti(d_.message,"Search");
		}

	},

	GetKeyword:function(){

		return $(this.SearchPageField).length?$.trim($(this.SearchPageField).val()):"";

	},

	GetParameters:function(item_){

		var type_= Helpers.HasAttribute(item_,Globals.ItemTypeAttribute)?item_.attr(Globals.ItemTypeAttribute):false,
			this_=this,
			offset=0;

		if(type_){

		switch(type_){

			case Globals.TypeUser:
			default:
			this_.UsersOffset++;
			offset=this_.UsersOffset;
			break;

			case Globals.TypeCircle:
			this_.CirclesOffset++;
			offset=this_.CirclesOffset;
			break;

			case Globals.TypePost:
			this_.PostsOffset++;
			offset=this_.PostsOffset;
			break;

		}		


		return {type:type_,offset:offset,k:this_.GetKeyword()};

		}


		return {};

	},
	
};


var Inbox={

	Trigger:".ib-user-conv-item",
	ConversationContainer:".ib-conv-container",
	UIDAttribute:Globals.UIDAttribute,
	MsgTextArea:".ib-msg-text",
	SendMessageBtn:".ib-send-msg",

	Init:function(){
	
	this.LoaConversationInit();
	this.SendMsgInit();
	
	},

	LoaConversationInit:function(){

	var this_=this;

	$(document).on("click",this.Trigger,function(e){

	var container_=$(this_.ConversationContainer);

	if(container_.length){

		this_.MakeActive($(this));

		this_.LoadInit($(this), container_);
	}	

	});	

	
	},

	SendMsgInit:function(){

	var this_=this;
		
	$(document).on("click",this.SendMessageBtn,function(e){
	
	var $this=$(this),
	    par_=$this.parents(this_.ConversationContainer+":first"),
	    textarea_=par_.find(this_.MsgTextArea),
	    msg=$.trim(textarea_.val()),
	    to_=$this.attr(Globals.UIDAttribute);
	
	if(!msg.length){
	
	textarea_.focus();

	return;
	
	}
	
	Preloaders.PutPreloader($this);	

	Promises.SendMessage(msg,to_,true).done(function(d){
	
	Preloaders.RemovePreloader($this);
	
	var d_=GetResponse.Get(d);

	if(d_){
	
	this_.AfterMessageSent(d_,par_,textarea_);

	}
	
	});
	
	});

	},

	AfterMessageSent:function(d,container,textarea_){
	
	if(d.status){
	
	container.find(".chat:last").after(d.data);
	
	textarea_.val("");
	
	this.FocusTextArea(container,textarea_);	

	AppNotifications.PutNoti(d.message,"Inbox","success");
	
	
	}else {
	
	AppNotifications.PutNoti(d.message,"Inbox","danger");
	
	}
	
	},
	
	MakeActive:function(elem_){

		var active_class="active";

		$(this.Trigger).removeClass(active_class);

		elem_.addClass(active_class);
	},

	LoadInit:function(elem_,container_){

		var uid_=Helpers.HasAttribute(elem_,this.UIDAttribute)?elem_.attr(this.UIDAttribute):false,
			this_=this;

		if(uid_){

		Preloaders.PutPreloader(container_);

		$.post(Helpers.AjaxURL("GetConversation"),{uid:uid_},function(d){

		Preloaders.RemovePreloader(container_);
	
			var d_=GetResponse.Get(d);

			if(d_){

			this_.AfterResponse(d_,container_);	

			}
		})

		}

	},

	AfterResponse:function(d_,container_){

		if(d_.status){

		container_.html(d_.data);

		this.FocusTextArea(container_);

		}

		else {

			AppNotifications.PutNoti(d_.message,"Inbox","error");
		}

	},


	FocusTextArea:function(container_,textarea_){
	
	var text_a=textarea_?textarea_:container_.find("textarea");
	
	text_a.focus();	

	$(document).scrollTo(text_a,500);
	
	},
};


var Promises={


FileUploadXHRObject:false,

AjaxResponse:function(url,data_){

var d=$.Deferred();

$.post(url,data_)

	.done(function(d_){
		
	d.resolve(d_);
	
	})

	.fail(d.reject);

	return d.promise();


},

UploadFile:function(file_elem,data_){

var d=$.Deferred(),
	file_=file_elem[0].files[0],
	fd = new FormData();

Helpers.Disable(file_elem);

fd.append(data_['file_name'], file_);

PutProgressBar.Init(file_elem,"primary");

var xhr = new XMLHttpRequest();

Globals.FileUploadXHRObject=xhr;

xhr.open('POST',data_['url'] , true);

xhr.upload.onprogress = function(e) {
if (e.lengthComputable) {
var percentComplete = (e.loaded / e.total) * 100;
PutProgressBar.UpdateProgressBar(file_elem,percentComplete);
}
};

xhr.onload = function() {
if (this.status == 200) {

var server_data_=GetResponse.Get(this.response);

if(server_data_){

	Helpers.Enable(file_elem);

	d.resolve(server_data_);
	//this_.AfterResponse(data_);
}

else {

d.reject

}

}

};

xhr.send(fd);

return d.promise();

},

AbortFileUpload:function(){

	if(Globals.FileUploadXHRObject){

		Globals.FileUploadXHRObject.abort();
	}
},


UploadCircleImage:function(file_elm){

return this.UploadFile(file_elm ,{file_name:"circle_image",url:Helpers.AjaxURL("UploadCircleImage") });

},

SendMessage:function(message_,to_,single_message_view){

return this.AjaxResponse(Helpers.AjaxURL("SendMessage"),{
		message:message_,
		to:to_,
		single_message_view:single_message_view?single_message_view:0,
		});

},


};



var SendMessage={

Trigger:".send-message-trigger",
Container:".send-msg-container",
TextArea:".text-msg-field",

Init:function(){

	var this_=this;

	$(document).on("click",this_.Trigger,function(e){

		this_.SendInit($(this));

	});
},

SendInit:function(elem_){

	var par_=elem_.parents(this.Container+":first"),
		textarea_=par_.find(this.TextArea),
		message_=$.trim(textarea_.val()),
		this_=this,
		to_=elem_.attr("to-id");

		if(!message_.length){

		textarea_.focus();		

		return;

		}

		Preloaders.PutPreloader(elem_);

		Promises.SendMessage(message_,to_).done(function(d){
	
		Preloaders.RemovePreloader(elem_);

		var d_=GetResponse.Get(d);
		
		if(d_){
		
		this_.AfterResponse(d_,par_);	
		
		}
	
		});
	

		
},


AfterResponse:function(d_,par_){

if(d_.status){

AppNotifications.PutNoti(d_.message,"Message","success");

if(d_.data.length){

par_.html($(d_.data).html()).removeClass("open");

}

}

else {

AppNotifications.PutNoti(d_.message,"Message","danger");


}

}

};


var UpdateProfile={

SaveTrigger:".pp-save-info",
BtnOriginalText:"Save",
FieldSelecterAttr:"field-selecter",
FieldAttr:"user-field",
Container:".pmbb-edit",
AboutContainer:".pp-about-content",

Init:function(){

var this_=this;

$(document).on("click",this.SaveTrigger,function(e){

var $this=$(this),
original_text=$this.text();

if(Helpers.HasAttribute($this,this_.FieldSelecterAttr)){

var data_=this_.GetFields($this,$this.attr(this_.FieldSelecterAttr));

if(!$.isEmptyObject(data_)){

$this.text("Saving...");

$.post(Helpers.AjaxURL("SaveProfileInfo"),{data:JSON.stringify(data_)},function(d){

$this.text(original_text);

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse($this,d_);

}

});

}

else {

//ModalAlert.Error("Please fill the fields");

}

}

});

},


AfterResponse:function(elem_,d_){

if(d_.status){

var container_=$(this.AboutContainer);

if(container_.length && d_.data.length){

container_.html(d_.data);

}

AppNotifications.PutNoti(d_.message,"Profile","success");

}

else {

AppNotifications.PutNoti(d_.message,"Profile","danger");

}

},

GetFields:function(elem_,fields_class){

var fields_=elem_.parents(this.Container+":first").find(fields_class),
    return_=new Object(),
    this_=this,
    put_focus=false;
	
if(fields_.length){

fields_.each(function(){

var $this=$(this),
    val_=$.trim($this.val());

if(Helpers.HasAttribute($this,this_.FieldAttr)){

return_[$this.attr(this_.FieldAttr)]=val_;


if(val_.length){
}

else {
if(!put_focus){
$this.focus();
put_focus=true;
}

}

}

});

}

return return_;

},

};


var ProfilePic={

	Triggerer:".update-prof-pic-trigger",
	UpdatePicContainer:"update-pic-container",
	UploadFileTrigger:"upload-prof-pic-btn",
	FileField:"prof-pic-file",
	ProfilePicWidget:".prof-pic-widget",
	RemovePicTriggerer:".remove-prof-pic",

	Init:function(){

		this.ChooseFileInit();
		this.FileChangeEvent();
		this.RemovePicInit();
		this.ActionInit();

		},

	ActionInit:function(){
	
	var this_=this;

	$(document).on("click",this_.Triggerer,function(e){

		ModalAlert.SetupModal("<div class='m-t-10 "+this_.UpdatePicContainer+"'>"+this_.GetPopupContent()+"</div>","Update Profile Picture",true);

		this_.LoadInit();

		});
	
	},

	ChooseFileInit:function(){

	var this_=this;	

	$(document).on("click","."+this.UploadFileTrigger,function(e){

		var file_=$("."+this_.FileField);

		if(file_.length){

			file_.click();
		}

	});


	},


	FileChangeEvent:function(){

		var this_=this;

		$(document).on("change","."+this.FileField,function(e){

			var $this=$(this),

			file_=AppComponents.GetValidImageFile($(this));

			if(file_)
			this_.UploadInit(file_,$this);

		});
	},



UploadInit:function(file_,file_elem){

var this_=this;

Promises.UploadFile(file_elem,{file_name:'profile_pic',url:Helpers.AjaxURL("UploadProfilePicture")}).done(function(data_){

		this_.AfterResponse(data_);

});

},

AfterResponse:function(d_){

if(d_.status){

ModalAlert.CloseAll();

AppNotifications.PutNoti(d_.message,"Profile Picture","success");

this.UpdatePictureWidget(d_.data);

}

else {

ModalAlert.Error(d_.message,"Profile Picture");


}


},

UpdatePictureWidget:function(d_){

var widget_=$(this.ProfilePicWidget);

if(widget_.length){

widget_.replaceWith(d_);

AppComponents.LightGalleryInit();

}

},


	LoadInit:function(){

		var container_=$("."+this.UpdatePicContainer);

		if(container_.length){

			//Preloaders.PutPreloader(container_);
		}

	},

	RemovePicInit:function(){
        
	var this_=this;
		
	$(document).on("click",this.RemovePicTriggerer,function(e){
	
	swal(Globals.GetSwalConfig(false,"You will not be able to recover this picture!"), function(){   
                	swal.close();
                    this_.DeleteInit(); 
                });

	});


	},
	
	DeleteInit:function(){
	
	var this_=this;
	
	$.post(Helpers.AjaxURL("RemoveProfilePic"),{flag:"true"},function(d){

	var d_=GetResponse.Get(d);

	if(d_ && d_.status){

	AppNotifications.PutNoti(d_.message,"Profile Picture","success");
	
	this_.UpdatePictureWidget(d_.data);

	} else {
	
	AppNotifications.PutNoti(d_.message,"danger");
	
	}	

	
	});

	},
	

	GetPopupContent:function(){

		return "<button class='btn btn-primary m-b-10 "+this.UploadFileTrigger+"'><i class='md md-photo-library'></i>&nbsp;Upload Picture</button><input type='file' class='none "+this.FileField+"' />";
	}
};

var PeopleVoted={

Triggerer:".people-voted-trigger",
VotesContainer:"people-votes-wrap",

Init:function(){

var this_=this;

$(document).on("click",this_.Triggerer,function(e){

var $this=$(this),
	post_id=$this.attr("post-id");

	ModalAlert.SetupModal("<div class='"+this_.VotesContainer+"'></div>","People who voted on this Post");

	this_.LoadInit(post_id);

});

},

LoadInit:function(post_id){

var container_=$("."+this.VotesContainer),
this_=this;

if(container_.length){
	Preloaders.PutPreloader(container_);

$.post(Helpers.AjaxURL("GetPostVotes"),{post_id:post_id},function(d){

	Preloaders.RemovePreloader(container_);

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse(container_,d_);

}

});

}

},

AfterResponse:function(container_,d_){

	if(d_.status){

		container_.html(d_.data);
	}
},


};

var Comments={

ToggleCommentsElem:".toogle-post-comments",
CommentsContainer:".post-comments-wrap",
PostCommentButton:".post-comment-button",
PostCommentText:".post-comment-text",
PostCommentWrap:".post-comment-wrap",
PostCommentsContainer:".post-comments-container",
CommentsCount:".comments-count",
SingleCommentWrap:Globals.SingleCommentWrap,

Init:function(){

this.CommentsToggleInit();
this.PostCommentsInit();
LoadMoreComments.Init();

},

CommentsToggleInit:function(){

var this_=this;

$(document).on("click",this.ToggleCommentsElem,function(e){

var par_=$(this).parents(Globals.CirclePostWrap+":first"),
    toggle_elem_=par_.length?par_.find(this_.CommentsContainer):false;

if(toggle_elem_){

toggle_elem_.toggle("fast",function(){

SetPostsGrid.Init();

});

}

});

},

PostCommentsInit:function(){

var this_=this;

$(document).on("click",this_.PostCommentButton,function(e){

if(!AccessControlCheck.Init("Please log in to be able to comment on this post."))return false;

var $this=$(this),
    par_=$this.parents(this_.PostCommentWrap+":first"),
    textarea_=par_.length?par_.find(this_.PostCommentText):false,
    text_=textarea_ && textarea_.length?$.trim(textarea_.val()):false,
    p_id=Helpers.HasAttribute($this,"p-id")?$this.attr("p-id"):0,
    container_=$this.parents(this_.PostCommentsContainer+":first"),
    original_text=$this.text();

    if(!text_ || !p_id){

	//AlertMessage.PutBox(par_,"Please write your comment","danger");
        textarea_.focus();
        return;

    }

    Preloaders.PutPreloader($this,"Posting...");
   
    $.post(Helpers.AjaxURL("Comment"),{p_id:p_id,text:text_},function(d){
     
    Preloaders.RemovePreloader($this,original_text);

    var data_=GetResponse.Get(d);
	
    if(data_){

    textarea_.val("").removeAttr("style");

    this_.AfterResponse(container_,data_);
	
    }

    });
 

});

},

AfterResponse:function(container_,data_){

if(data_.status){

container_.find("li:first").after(data_.data);

this.AfterSuccess(container_,data_);

}

else {

AppNotifications.PutNoti(data_.message,"danger");

}

},

AfterSuccess:function(container_,data_){

AppNotifications.PutNoti(data_.message,false,"success");

this.UpdateCommentsCount(container_);

SetPostsGrid.Init();

},

UpdateCommentsCount:function(container_,action_){

var counter_=container_.parents(Globals.CirclePostWrap+":first").find(this.CommentsCount);

if(counter_.length){

var current_count=counter_.text();

current_count=current_count.length?parseInt(current_count):0;

if(!action_ || action_=="increment"){

current_count++;

}

else {

current_count--;

if(!current_count)current_count="";

}

counter_.html(current_count);

}

},

DeleteComment:function(elem_){

var this_=this;

swal(Globals.GetSwalConfig(false,"You will not be able to recover this comment!"), function(){   
                	swal.close();
                    this_.DeleteInit(elem_); 
                });

},


DeleteInit:function(elem_){

var comment_id=elem_.attr("comment-id"),
    this_=this;

$.post(Helpers.AjaxURL("DeleteComment"),{comment_id:comment_id},function(d){

var d_=GetResponse.Get(d);

if(d_){

this_.AfterDeleteResponse(elem_,d_);

}

});

},

AfterDeleteResponse:function(elem_,data_){

if(data_.status){

var elem_to_remove=elem_.parents(this.SingleCommentWrap+":first");

if(elem_to_remove.length){

	this.UpdateCommentsCount(elem_,"decrement");

	elem_to_remove.remove();

	SetPostsGrid.Init();

	AppNotifications.PutNoti(data_.message,"Comments","success");


}

}

else {

	AppNotifications.PutNoti(data_.message,"Comments","danger");
}


},


};


var LoadMoreComments={

 Triggerer:".load-all-comments",
 CommentsWrap:Comments.CommentsContainer,
 Container:".post-comments-container",
 SingleCommentWrap:Comments.SingleCommentWrap,


	Init:function(){

	var this_=this;

    $(document).on("click",this.Triggerer,function(e){

    var $this=$(this),
        wrap=$this.parents(this_.CommentsWrap+":first"),
        container_=wrap.find(this_.Container+":first"),
        last_comment_=container_.find(this_.SingleCommentWrap+":last"),
        comment_attr="comment-id",
        post_id=$this.attr("post-id");

        last_comment_=last_comment_.length && Helpers.HasAttribute(last_comment_,comment_attr)?last_comment_.attr(comment_attr):0;

        Preloaders.PutPreloader($this);

        $.post(Helpers.AjaxURL("LoadMoreComments"),{post_id:post_id,last_comment_id:last_comment_},function(d){

        Preloaders.RemovePreloader($this);

        	var d_=GetResponse.Get(d);

        	if(d_){

        		this_.AfterResponse(container_,$this,d_);
        	}

        });


    });

	},

AfterResponse:function(container_,triggerer,d_){

if(d_.status && $.trim(d_.data).length ) {

container_.append(d_.data);

triggerer.remove();

SetPostsGrid.Init();

}

else {

	AppNotifications.PutNoti(d_.message,"Comments");
}


},

};




var LikePosts={

BtnElement:".post-like-btn",

Init:function(){

var this_=this;

$(document).on("click",this.BtnElement,function(){

if(!AccessControlCheck.Init("Please log in to be able to like this post."))return false;

var $this=$(this),
    p_id=$this.attr("p-id"),
    action_=$this.attr("l-action");

$.post(Helpers.AjaxURL("LikeUnlike"),{p_id:p_id,action:action_},function(d){

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse($this,d_);

}


});


});


},


AfterResponse:function(elem_,d){

if(d.status){

InsertIntoPostFeed.RefreshPost(elem_,d.data);


}

else {

AppNotifications.PutNoti(d.message,"Like","danger");

}

},




};



var RealTime={

TimeInterval:3000,
HitServer:true,
PreservedAjaxObject:false,
TourGone:false,

Init:function(){

var this_=this;

setInterval(function(){

this_.Hit();

},this.TimeInterval);

},

Hit:function(){

var this_=this;

if(this.HitServer){

this.HitServer=false;	

this.PreservedAjaxObject= $.post(Helpers.AjaxURL("RealTime"),

{

first_post:InsertIntoPostFeed.FirstPostId(),
current_circle:Globals.CurrentCircleId,
last_invite:CircleInvitesAction.LastInviteId(),
last_notification:CircleInvitesAction.LastNotificationId(),
app_meta:Globals.GetAppMeta(),
cids:JSON.stringify(CirclesBar.GetCids()),

}

,function(d){

this_.HitServer=true;	

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse(d_);

}

});

}

},

Abort:function(){

	this.HitServer=false;

	if(this.PreservedAjaxObject){

		this.PreservedAjaxObject.abort();
	}
},

Resume:function(){

	this.HitServer=true;
},


AfterResponse:function(d_){

if(d_.status && d_.data){

var posts_=d_.data.posts,
    invites=d_.data.invites,
    user=d_.data.user, 
    notifications=d_.data.notifications,
    new_posts=d_.data.circle_new_posts;

if(user.id){
this.HandleUserActions(user);
}

if(posts_.length){
InsertIntoPostFeed.Init(posts_,"prepend",true);
}

if(invites.length){
CircleInvitesAction.PutInvites(invites);
}

if(notifications.length){
CircleInvitesAction.PutNotifications(notifications);
}

if(new_posts.length){
CirclesBar.UpdateCircleNewPostsCount(new_posts);

}

}

},

HandleUserActions:function(user){

if(user.message ){
AppNotifications.PutNoti(user.message,"Message","inverse",false,"animated bounceIn","animated bounceOut"); 
}

if(user.tour_enabled && !this.TourGone){
	AppTour.Init();
	this.TourGone=true;
}

},

};

var LoadMorePosts={


	Offset:1,
	TempLoaderClass:"temp-post-loader",
	Load:true,
	WayPointPreservedObject:false,
	PreservedAjaxObject:false,

	Init:function(){

		var this_=this;
			
			this_.Offset=1;
			this_.Load=true;
			this_.WayPointPreservedObject=false;

			this.GetMorePosts();


	},


	Abort:function(){

		if(this.PreservedAjaxObject){

			this.Load=false;

			this.PreservedAjaxObject.abort();
		}

	},


	Resume:function(){

		this.Load=true;

	},

	GetMorePosts:function(){


	var this_=this, 
	last_item=$(Globals.CirclePostWrap+":last");


	if(last_item.length){

    this_.WayPointPreservedObject = new Waypoint({
  	element: last_item[0],
  	offset:'50%',
  	handler: function(direction) {

  	if(direction=='down' && this_.Load && last_item.isOnScreen()){

  			this_.LoadInit(last_item);

  			}
    
  		}
	});


	}
	

	},


	GetLastPost:function(){

		var elem=$(Globals.PostFeedCoulmn),
		t=0, 
		t_elem=false;

		$(elem).each(function () {
    	$this = $(this);
    	if ( $this.outerHeight() > t ) {
        t_elem=this;
        t=$this.outerHeight();
    	}
		});

		
		if(t_elem){

		return $(t_elem).find(Globals.CirclePostWrap+":last");	

		}

		return false;


	},

	LoadInit:function(last_post){

		var loader_=this.PutPreloader(last_post),
		    this_=this;
		
		this.Load=false;		

		Preloaders.PutPreloader(loader_);

		this_.PreservedAjaxObject=$.post(Helpers.AjaxURL("GetPosts"),{cid:Globals.CurrentCircleId,offset:(this.Offset)},function(d){

		loader_.remove();	

			var d_=GetResponse.Get(d);

			if(d_){

				
				this_.AfterResponse(d_);
			}

		});

	},

	AfterResponse:function(d_){

	if(d_.status){

	this.Load=true;	

	this.Offset++;

	if(this.WayPointPreservedObject){

		this.WayPointPreservedObject.destroy();
	}

	InsertIntoPostFeed.Init(d_.data,"append");

	this.GetMorePosts();
	
	}


	else {

	this.Load=false;	

	AppNotifications.PutNoti("No more posts in this Circle");


	}	

	},


	PutPreloader:function(last_post){

		if(!last_post.next().hasClass(this.TempLoaderClass)){

		last_post.after("<div class='"+this.TempLoaderClass+"'></div>");

		}

		return $("."+this.TempLoaderClass);
		
	},



};


var BootstrapMenus={

	InitMenus:function(){

	this.Init(".tm-invitation",".c-invites-dropdown");	
	this.Init(".tm-notification",".c-notifications-dropdown");	

	},


	Init:function(trigger_class,menu_container_class){


		var triggerer_=$(trigger_class),
			this_=this;

			triggerer_.on('click', function (event) {
						
		    event.stopPropagation();

		    //Close any previously open dropdown

		    $(".dropdown.open").removeClass('open');

    		$(this).parent().toggleClass('open');

    		return false;

			});

		this_.CloseOnClickOutside(triggerer_,$(menu_container_class));	


		
	},


	CloseOnClickOutside:function(elem_,menu_){


		$(document).click(function(e) {
    	
    	if( elem_.parent().hasClass("open" )){

    		elem_.parent().removeClass("open");

    	}
		
		});


		menu_.on("click",function(event) {
    	//alert('clicked inside');
	   	 event.stopPropagation();
		});
		

	},


};

var NotificationAutoLoad = {
	NotificationElement:".single-notification",
	NotificationsContainer:".notifications-container",
	LoadingFlag:false,
	MoreAvailable:true,
	NoNotificationsClass:".no-new-notifications",
	NotificationsCountClass:".notifications-count",
	Init:function()
	{
		var this_=this;
	    $(this_.NotificationsContainer).on('scroll', function() {
		   	if(this_.LoadingFlag==false&&this_.MoreAvailable==true)
		    {     

		        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-50) {
		           
		           		this_.LoadingFlag = true;
		           		$(this_.NotificationsContainer).append("<div class='loader_div_notfications'></div>");
		           		Preloaders.PutPreloader($(".loader_div_notfications"));
		           		var last_id = $(".single-notification:last").attr("notification-id");
		           		$.post(Helpers.AjaxURL("MoreNotifications"),{last_id:last_id},function(d){
			           		var d_=GetResponse.Get(d);
			           		if(d_.data.notifications.length>0)
			           		{
			           			this_.PutNotifications(d_.data.notifications);
			           			this_.LoadingFlag = false;
			           		}
			           		else
			           		{
			           			AppNotifications.PutNoti("No more notifications available.");
			           			this_.MoreAvailable = false;
			           			this_.LoadingFlag = false;
			           		}
			           		if($(".loader_div_notfications").length)
							{
								$(".loader_div_notfications").remove();
							}
						});
		        }	
		    }
	    })
	},
	PutNotifications:function(notifications){

		var elem_=$(this.NotificationsContainer),
		    data_=this.NotificationsToPush(notifications);

		if(elem_.length && $.trim(data_).length){

		elem_.append(data_);

		if(!$(this.LVHeader).find(".c-notification-all").length)
		{
			$(this.LVHeader).append(Globals.RemoveAllContent);
		}

		this.AfterPushNotifications();

		}

	},
	AfterPushNotifications:function(){

		var elem_=$(this.NoNotificationsClass);

		if(elem_.length){

			elem_.hide();
		}

	},
	NotificationsToPush:function(notifications){

		var final_="",
		    this_=this;

		for(i in notifications ){

		var elem_=$(notifications[i]);

		if(!$("#"+elem_.attr("id")).length){

		final_+=notifications[i];

		//this_.UpdateNotificationsCount();

		}

		}

		return final_;

	},
	UpdateNotificationsCount:function(action_){

		var elem_=$(this.NotificationsCountClass);
		    
		if(elem_.length){

		    var current_count_=$.trim(elem_.text());
		    if(!current_count_)current_count_=0;
		    else current_count_=parseInt(current_count_);


		if(!action_ || action_=="increment"){

		current_count_++;

		}

		else {

		current_count_--;

		}

		if(current_count_>0){
		elem_.text(current_count_).removeClass("none");
		}

		else {
		elem_.addClass("none");
		}

		}

	},
};


var CircleInvitesAction={

Triggerer:".c-invite-action",
TriggererNotification:".c-notification-action,.action_notification",
TriggererAllNotification:".c-notification-all",
InviteIdAttr:"invite-id",
NotificationIdAttr:"notification-id",
LVHeader:".lv-notification-header",
InviteElement:Globals.InviteElement,
InvitesContainer:".invites-container",
NoInviteClass:".no-new-invites",
ActionPerformed:false,
InvitesCountClass:".invites-count",
NotificationElement:Globals.NotificationElement,
NotificationsCountClass:Globals.NotificationsCountClass,
NotificationsContainer:".notifications-container",
NotificationsCount:".notifications-count",
NoNotificationsClass:".no-new-notifications",

Init:function(){

var this_=this;

$(this_.InvitesContainer).on("click",this_.Triggerer,function(){

var 	$this=$(this),
	par_=$this.parents("div:first"),
	action_=$this.attr(Globals.AppActionAttr),
	invite_id=$this.attr(this_.InviteIdAttr);

if(par_.length){

Preloaders.PutPreloader(par_);

$.post(Helpers.AjaxURL("HandleInvite"),{action:action_,invite_id:invite_id,container_width:Globals.GetCirclesContainerWidth()},function(d){

this_.ActionPerformed=action_;

Preloaders.RemovePreloader(par_);

var d_=GetResponse.Get(d);

if(d_){

	this_.AfterResponse(d_,par_);
}

});

}


});

$(this_.NotificationsContainer).on("click",this_.TriggererNotification,function(){

var 	$this=$(this),
	par_=$this.parents("div:first"),
	notification_id=$this.attr(this_.NotificationIdAttr);

if(par_.length){

Preloaders.PutPreloader($this);

$.post(Helpers.AjaxURL("HandleNotification"),{action:"accept",notification_id:notification_id,container_width:Globals.GetCirclesContainerWidth()},function(d){

this_.ActionPerformed="accept";

Preloaders.RemovePreloader(par_);

var d_=GetResponse.Get(d);

if(d_){

	this_.AfterResponseNotification(d_,$this);
	$("#notification-"+notification_id).removeClass("gray_background");
}

});

}


});

$(this_.LVHeader).on("click",this_.TriggererAllNotification,function(){

var 	$this=$(this),
	par_=$this.parents("div"),
	notification_id=$this.attr(this_.NotificationIdAttr);

if(par_.length){

Preloaders.PutPreloader($this);

$.post(Helpers.AjaxURL("HandleNotification"),{action:"all",notification_id:notification_id,container_width:Globals.GetCirclesContainerWidth()},function(d){

this_.ActionPerformed="accept";

Preloaders.RemovePreloader(par_);

var d_=GetResponse.Get(d);

if(d_){
	$(this_.TriggererNotification).remove();
	$(this_.TriggererAllNotification).remove();
	$(this_.NotificationsCount).html("0");
	$(this_.NotificationsCount).addClass("none");
	$( ".single-notification" ).each(function( index ) {
	  $(this).removeClass("gray_background");
	});
}

});

}


});

},

AfterResponseNotification:function(data_,par_){

if(data_.status){
	
	this.UpdateNotificationCount("decrement");
	$(".c-notification-action[notification-id='"+par_.attr("notification-id")+"']").remove();
	$(".action_notification.disable-click").removeClass("disable-click");
	//par_.remove();
	
}

else {


}


},

AfterResponse:function(data_,par_){

if(data_.status){
	
	this.UpdateNotiCount("decrement");

	par_.html(Helpers.ResponseMessage(data_.message));

	if(data_.data.length && this.ActionPerformed!="reject"){

	PushCircle.init(data_.data);

	CirclesBar.LoadBar();

	}

	//AppEffects.Animate(par_,"bounceInDown");
}

else {


}


},


PutInvites:function(invites){

var elem_=$(this.InvitesContainer),
    data_=this.InvitesToPush(invites);

if(elem_.length && $.trim(data_).length){

elem_.prepend(data_);

this.AfterPush();

}

},

PutNotifications:function(notifications){

var elem_=$(this.NotificationsContainer),
    data_=this.NotificationsToPush(notifications);

if(elem_.length && $.trim(data_).length){

elem_.prepend(data_);

if(!$(this.LVHeader).find(".c-notification-all").length)
{
	$(this.LVHeader).append(Globals.RemoveAllContent);
}

this.AfterPushNotifications();

}

},

UpdateNotiCount:function(action_){

var elem_=$(this.InvitesCountClass);
    
if(elem_.length){

    var current_count_=$.trim(elem_.text());
    if(!current_count_)current_count_=0;
    else current_count_=parseInt(current_count_);


if(!action_ || action_=="increment"){

current_count_++;

}

else {

current_count_--;

}

if(current_count_>0){
elem_.text(current_count_).removeClass("none");
}

else {
elem_.addClass("none");
}

}

},

UpdateNotificationCount:function(action_){

var elem_=$(this.NotificationsCountClass);
    
if(elem_.length){

    var current_count_=$.trim(elem_.text());
    if(!current_count_)current_count_=0;
    else current_count_=parseInt(current_count_);


if(!action_ || action_=="increment"){

current_count_++;

}

else {

current_count_--;

}

if(current_count_>0){
elem_.text(current_count_).removeClass("none");
}

else {
$(Globals.TriggererAllNotification).remove();
elem_.addClass("none");
}

}

},

UpdateNotificationsCount:function(action_){

var elem_=$(this.NotificationsCountClass);
    
if(elem_.length){

    var current_count_=$.trim(elem_.text());
    if(!current_count_)current_count_=0;
    else current_count_=parseInt(current_count_);


if(!action_ || action_=="increment"){

current_count_++;

}

else {

current_count_--;

}

if(current_count_>0){
elem_.text(current_count_).removeClass("none");
}

else {
elem_.addClass("none");
}

}

},

AfterPush:function(){

	var elem_=$(this.NoInviteClass);

	if(elem_.length){

		elem_.hide();
	}

},

AfterPushNotifications:function(){

	var elem_=$(this.NoNotificationsClass);

	if(elem_.length){

		elem_.hide();
	}

},

InvitesToPush:function(invites){

var final_="",
    this_=this;

for(i in invites ){

var elem_=$(invites[i]);

if(!$("#"+elem_.attr("id")).length){

final_+=invites[i];

this_.UpdateNotiCount();


}

}

return final_;

},

NotificationsToPush:function(notifications){

var final_="",
    this_=this;

for(i in notifications ){

var elem_=$(notifications[i]);

if(!$("#"+elem_.attr("id")).length){

final_+=notifications[i];

this_.UpdateNotificationsCount();


}

}

return final_;

},


LastInviteId:function(){

var elem_=$(this.InviteElement+":first"),
    attr_="invite-id";

if(elem_.length && Helpers.HasAttribute(elem_,attr_)){

return elem_.attr(attr_);

}

return 0;

},

LastNotificationId:function(){

var elem_=$(this.NotificationElement+":first"),
    attr_="notification-id";
if(elem_.length && Helpers.HasAttribute(elem_,attr_)){

return elem_.attr(attr_);

}

return 0;

}

};


var InvitePeopleSearch={

	SearchField:"#ppl-on-site-field",

	Init:function(){

		var field_=$(this.SearchField);

		if(field_.length){

			field_.tokenInput( (!isMobile.iOS()?Helpers.AjaxURL("SearchPeople"):[]), {
               		 theme: "facebook",
               		 hintText:"Type name, email or user id",
               		 zindex: 9999,
					 preventDuplicates: true,
					 resultsFormatter:function(item){

					 	return "<li><img height='30' width='30' src='"+item.image+"' /> &nbsp;"+item.name+"</li>";

					 }
					 	,

    onResult: function (item) { return item;
        if($.isEmptyObject(item)){
              return [{id:'0',name: $("tester").text()}]
        }else{

              return item
        }

    },


            }

				);
		}

	},


	InvitedPeopleIds:function(){
		
	var field_=$(this.SearchField);
	
	if(field_.length){
	
	return field_.tokenInput("get");
	
	}
	
	return false;
	
	},

};


var SendInvites={


Triggerer:"#invite-ppl-trigger-btn",

Init:function(){

var this_=this;

$(document).on("click",this.Triggerer,function(){

var uids=InvitePeopleSearch.InvitedPeopleIds();

if(uids && uids.length){

this_.Send(uids, $(this));

}


else {


ModalAlert.Error("Please type an email or name to find a user.", "No keyword provided");

}

return false;

});


},


Send:function(data_,btn_){

var this_=this,
	original_text=btn_.html();

Preloaders.PutPreloader(btn_,"Inviting...");

$.post(Helpers.AjaxURL("SendInvites"),{data_:JSON.stringify(data_),cid_:btn_.attr(Globals.CIDAttribute)},function(d){

Preloaders.RemovePreloader(btn_,original_text);

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse(d_);


}


});

},

AfterResponse:function(d_){

if(d_.status){

ModalAlert.CloseAll();

AppNotifications.PutNoti(d_.message,"Invites","success");


}


else {

ModalAlert.Error(d_.message);

}

},


};


var AddCirclePopup={


AddCircleContainer:"add-circle-container",
PopUpTrigger:".add-circle",

Init:function(){

var this_=this;

$(document).on("click",this.PopUpTrigger,function(){

ModalAlert.SetupModal("<div class='"+this_.AddCircleContainer+"'></div>","Create a Circle",true);

this_.LoadPopup();

});


},


LoadPopup:function(){

var elem=$("."+this.AddCircleContainer),
	this_=this;

if(elem.length){

Preloaders.PutPreloader(elem);

$.post(Helpers.AjaxURL("LoadAddCirclePopup"),{flag:true},function(d){

var d_=GetResponse.Get(d);

if(d_){

this_.AfterResponse(d_);

}

});

}

},


AfterResponse:function(d_){

if(d_.status){

var container_=$("."+this.AddCircleContainer);

if(container_.length){

container_.html(d_.data);

AppComponents.SelectPickerInit();

Helpers.FocusOnFirstInput(container_);

}

}

},

};


var UploadCircleImage={

CircleImageTrigger:".circle-add-image-trigger",
CircleImageFile:"#circle-image-file",

Init:function(){

var file_elem=$(this.CircleImageFile);

if(file_elem.length){

file_elem.click();

}

},

UploadFileInit:function(elem){

var file = elem.files[0];

if(!Helpers.IsImage(file)){

ModalAlert.Error(Globals.InvalidImageMessage,"Invalid image file");

return false;

}

this.UploadInit(file,$(elem));

},

UploadInit:function(file_,file_elem){

var fd = new FormData(),
this_=this;
fd.append("circle_image", file_);

PutProgressBar.Init(file_elem,"primary");

var xhr = new XMLHttpRequest();
xhr.open('POST',Helpers.AjaxURL("UploadCircleImage") , true);

xhr.upload.onprogress = function(e) {
if (e.lengthComputable) {
var percentComplete = (e.loaded / e.total) * 100;
PutProgressBar.UpdateProgressBar(file_elem,percentComplete);
console.log(percentComplete + '% uploaded');
}
};

xhr.onload = function() {
if (this.status == 200) {

var data_=GetResponse.Get(this.response);

if(data_){

	this_.AfterResponse(data_);
}

}

};

xhr.send(fd);

},

AfterResponse:function(d_){

if(d_.status){

var input_=$(Globals.CircleImageNameField);

if(input_.length){

input_.val(d_.data.image);

}

}

else {

ModalAlert.Error(d_.message);

}

},




};


var AppArrow={

ArrowCordinates:[ [ 2, 0 ], [ -10, -4 ],[ -10, 4]],
CanvasId:"arrow-canvas",

Draw: function (canvas_,cords) {
	
    var ctx=canvas_.getContext('2d');
    ctx.beginPath();
    ctx.moveTo(cords.x1,cords.y1);
    ctx.lineTo(cords.x2,cords.y2);
    ctx.stroke();
    var ang = Math.atan2(cords.y2-cords.y1,cords.x2-cords.x1);
    this.DrawFilledPolygon(this.TranslateShape(this.RotateShape(this.ArrowCordinates,ang),cords.x2,cords.y2),ctx);

},

GetCanvas:function(style_){

var canvas_= $("#"+this.CanvasId),
this_=this,
style_=style_?style_:{};

if(!canvas_.length){

$('<canvas>').attr({
    id: this_.CanvasId,
    class: this_.CanvasId
}).css(style_).appendTo('body');

}


return document.getElementById(this.CanvasId);

},

RotateShape: function (shape,ang)
{
    var rv = [];
    for(p in shape)
        rv.push(this.RotatePoint(ang,shape[p][0],shape[p][1]));
    return rv;
},


RotatePoint: function (ang,x,y) {
    return [
        (x * Math.cos(ang)) - (y * Math.sin(ang)),
        (x * Math.sin(ang)) + (y * Math.cos(ang))
    ];
},

TranslateShape: function (shape,x,y) {
    var rv = [];
    for(p in shape)
        rv.push([ shape[p][0] + x, shape[p][1] + y ]);
    return rv;
},

DrawFilledPolygon: function (shape,ctx) {
    ctx.beginPath();
    ctx.moveTo(shape[0][0],shape[0][1]);

    for(p in shape)
        if (p > 0) ctx.lineTo(shape[p][0],shape[p][1]);

    ctx.lineTo(shape[0][0],shape[0][1]);
    ctx.fill();
},

DrawBetweenElements:function(from_elm,to_elm){


var starting_points=from_elm.offset(),
end_points=to_elm.offset(),
canvas_width=Math.abs(end_points.left-(starting_points.left+from_elm.width())),
canvas_height=(starting_points.top+from_elm.height())-end_points.top,
canvas_l=end_points.left-canvas_width,
canvas_t=end_points.top,
can_=this.GetCanvas({

height:canvas_height+"px",
width:canvas_width+"px",
top:canvas_t+"px",
left:canvas_l+"px"

});

this.Draw(can_,{

x1:10,
y1:canvas_height-30,
x2:canvas_width-130,
y2:35,

});

return can_;

},

Destroy:function (){

	var can_=$("#"+this.CanvasId);

	if(can_.length){

		can_.remove();

	}
}

};

var DeleteFeedPost={

TriggerElem:".delete-feed-post",
PostIdAttr:"post-id",

Init:function(){

var this_=this;

$(document).on("click",".circle-data-wrap .dropdown-menu li",function(e){

	e.preventDefault();

});


},


DeletePost:function(elem){

var $this=elem,
post_id=Helpers.HasAttribute($this,DeleteFeedPost.PostIdAttr)?$this.attr(DeleteFeedPost.PostIdAttr):false,
this_=this;

if(post_id){

					swal(Globals.GetSwalConfig(false,"You will not be able to recover this post!"), function(){   
                	swal.close();
                    this_.DeleteInit($this,post_id); 
                });


}

},

DeleteInit:function(elem,post_id){

var $this=elem,
this_=this;

Preloaders.PutPreloader($this);

$.post(Helpers.AjaxURL("DeletePost"),{post_id:post_id},function(d){

var d_=GetResponse.Get(d);

Preloaders.RemovePreloader($this);

if(d_){

this_.AfterResponse(d_,$this);

}

});

},


AfterResponse:function(d_,elem){

if(d_.status){

var post_=elem.parents(Globals.CirclePostWrap+":first");

if(post_.length){

	post_.slideUp("slow",function(){

		$(this).remove();

		SetPostsGrid.Init();
		
	});

	AppNotifications.PutNoti(d_.message,"Post","success");

}

}

else {


	ModalAlert.Error(d_.message);
}

}

};


var PutProgressBar={

ProgressBarClass:"progress-bar-elem",
ProgressBarWrap:"progress-bar-wrap",
ProgressTextClass:"progress-text",
PreviewElement:"progress-file-preview",
CancelFileUploadBtn:"cancel-file-upload",

Init:function(elm_,type_){

this.Removebar(elm_);

elm_.after(this.GetProgressBar(elm_,type_));

},

GetProgressBar:function(elm_,type_){

	var file=elm_[0].files[0],
		this_=this;

		if(!Helpers.HasAttribute(elm_,"id")){

		elm_.attr("id",Helpers.Guid());

		}

	    var reader = new FileReader();
	    reader.onload = function (e) {
        $("."+this_.PreviewElement).attr("src",e.target.result);
    };

    reader.readAsDataURL(file);

return '<div class="'+this.ProgressBarWrap+' m-t-10 m-b-10">'+(!isMobile.any()?'<div class="col-md-2"><img class="'+this.PreviewElement+' w-100" src=""/></div>':'')+'<div class="col-md-'+(isMobile.any()?12:10)+'"><div class="grey small m-l-5 m-t-5"><span class="'+this.ProgressTextClass+'">Uploading....</span><a file-element="'+elm_.attr("id")+'" onclick="PutProgressBar.RemoveProgressBar($(this))" href="javascript:void(0)" class="m-l-5 small '+this.CancelFileUploadBtn+'">Cancel</a></div><div class="progress progress-striped m-t-5"><div aria-valuemax="100" aria-valuemin="0" aria-valuenow="14" role="progressbar" class="progress-bar progress-bar-'+(type_?type_:"success")+' '+this.ProgressBarClass+' bgm-cyan"></div></div></div><div class="clearfix"></div></div>';

},

RemoveProgressBar:function(elem){

var file_elem=$("#"+elem.attr("file-element"));

if(file_elem.length){

this.Removebar(file_elem);

Helpers.Enable(file_elem);

}


Promises.AbortFileUpload();

},


UpdateProgressBar:function(elm_,width_){

var progress_bar=this.GetBarElement(elm_);

if(progress_bar){

var progress_elm=progress_bar.find("."+this.ProgressBarClass),
progress_text_elem=progress_bar.find("."+this.ProgressTextClass);

if(progress_elm.length)
progress_elm.css("width",width_+"%");

if(progress_text_elem.length){

if(width_==100){

	var text_="<i class='md md-done green-c b'></i> Image Uploaded";

	progress_bar.find(".progress").remove();

	$("."+this.CancelFileUploadBtn).remove();

}

else {

	var text_="Uploading......"+parseInt(width_)+"% ";

}

progress_text_elem.html(text_);

}

}

},

GetBarElement:function(elem){

var progress_bar=elem.next();

return progress_bar.hasClass(this.ProgressBarWrap)?progress_bar:false;

},

Removebar:function(elem){

var bar_=this.GetBarElement(elem);

if(bar_.length){

bar_.remove();

}

},

};


var UploadPostImage={

PostImageTriggerer:".status-add-image-trigger",
PostImageFileElement:"#post-img-file",

Init:function(){

var this_=this;

this_.GetFileInit();

$(document).on("click",this.PostImageTriggerer,function(e){

var file_elm=$(this_.PostImageFileElement);

if(file_elm.length){

file_elm.click();

}


});


},



GetFileInit:function(){

var this_=this;

$(document).on("change",this_.PostImageFileElement,function(e){

var file = AppComponents.GetValidImageFile($(this));

if(file){

this_.UploadInit(file,$(this));

}

});

},

UploadInit:function(file_,file_elem){

var this_=this;

Promises.UploadFile(file_elem,{file_name:'post_image',url:Helpers.AjaxURL("UploadPostImage")}).done(function(data_){

		this_.AfterResponse(data_);

});

},

AfterResponse:function(data_){

if(!data_.status){

ModalAlert.Error(data_.message);

}

else {

this.OnSuccess(data_)

}


},

OnSuccess:function(data_){

var post_image=$(Globals.PostImageNameField);

if(post_image.length && data_.data.image){

	post_image.val(data_.data.image);

 	PostPreview.UpdatePostPreview(true);
}

},

GetUploadedFileName:function(){

var post_image=$(Globals.PostImageNameField);

return post_image.length && post_image.val()?post_image.val():false;

},

};


//Class for Detecting Mobile devices
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};


var AppComponents={

init:function(){

this.RolloverRotate();
this.FocusonFirstField();
CirclesRollover.Init();
this.LightBoxInit();
this.FixPostsContainer();
this.FocusOnFirstFieldInModal();
this.CollapseInit();
this.SelectPickerInit();
this.RefreshSliderOnResize();
this.OnlyNumbers();
this.TextAreaAutoSize();
this.LightGalleryInit();
this.FixLandingPage();
},


LightGalleryInit:function(){

	var elems_=$(".lightgallery-init");
	
	if(elems_.length){

	elems_.each(function(){

	var $this=$(this);
	
	if(!isMobile.any() || !Helpers.HasAttribute($this,Globals.MobileExceptionAttribute)){
	
	$this.lightGallery({
            enableTouch: true
        });
	
	}
	
	});

	}

	 
},


SelectPickerInit:function(){

	if ($.fn.selectpicker) {

	$('.selecstpicker').selectpicker();

	}
},

RefreshSliderOnResize:function(){


	function LoadSlider(){

		setTimeout(function(){CirclesSlider.LoadSlider();},200);
	};


	if(!isMobile.any()){

	window.addEventListener("resize",function(){

	LoadSlider();	
		
	});	

	}

	else {

		 $(window).on("orientationchange",function(){

		 LoadSlider();
	
		 });
	}

},

CollapseInit:function(){

	//Add active class for opened items
        $('.collapse').on('show.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });
   
        $('.collapse').on('hide.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').removeClass('active');
        });
        
        //Add active class for pre opened items
        $('.collapse.in').each(function(){
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });
},


GetValidImageFile:function(file_field){

	var $this=$(file_field),

			file_=$this[0].files[0];

			if(!Helpers.IsImage(file_)){

				ModalAlert.Error(Globals.InvalidImageMessage,"Invalid Image");

				return false;
			}

			return file_;
},


FixPostsContainer:function(){

	var timer_=setInterval(function(){

		var grid_container=$(Globals.PostsGridContainer),
			data_container=$(Globals.CircleDataWrap);

			if(grid_container.length && data_container.length){

				var height=grid_container[0].style.height;

				if(height.length){

					height=parseInt(height.replace("px",""));

					data_container.css("height", (height+100)+"px" );

				}
				

			}		


	},500);
},

RolloverRotate:function(){

$(document).on("mouseenter",".rollover-rotate",function(){

$(this).rotate(360);

});

},

CurrentTotalPosts:function(){

return $(Globals.CirclePostWrap).length;

},

FocusonFirstField:function(){

if(!isMobile.any()){
$(':input:enabled:visible:first').focus();
}

},

LightBoxInit:function(){

var attr_="light-box-init";

$(document).on("mouseenter",".lightbox",function(e){

var $this=$(this);

if(!Helpers.HasAttribute($this,attr_)){

	$this.lightGallery({
            enableTouch: true,
        }).attr(attr_,"true");


}

});
	
},

FocusOnFirstFieldInModal:function(){

$('body').on('shown.bs.modal', '.modal', function () {

    	var elm_=$(this).find('input[type=text],textarea').filter(':enabled:visible:first');

    	Helpers.FocusOnFirstInput($(this));

    	
    })

},

OnlyNumbers:function(){

	$(document).on("keypress",".only-number",function(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;

	})
},


TextAreaAutoSize:function(){

	$(document).on("mouseenter","textarea",function(e){

       var class_to_add="initialized-autosize",
            $this=$(this); 
	
       if(!$this.hasClass(class_to_add)){

        $this.addClass(class_to_add);

        $this.autosize().on('autosize.resized', function(){

        SetPostsGrid.Init();

        });

         SetPostsGrid.Init();

       }

	});

},


FixLandingPage:function(){

	if(!isMobile.any()){

		var elem_=$("#headerwrap");

		if(elem_.length){

			elem_.css("min-height",$(window).height()+22)
		}


	}
}


};


var AddPostPopup={

TriggerElem:".add-post-trigger",
CidAttribute:"cid",
ContainerElement:Globals.AddPostContainer,

Init:function(){

var this_=this;

$(document).on("click",this.TriggerElem,function(e){

var $this=$(this);

if(Helpers.HasAttribute($this,this_.CidAttribute)){

var cid=$this.attr(this_.CidAttribute);

ModalAlert.SetupModal("<div class='"+this_.ContainerElement+"'></div>","Add a Post",true);

this_.LoadData(cid);

}

});


},

ActivateStatusBox:function(){

var item_=$("."+this.ContainerElement).find(".add-new-item");

if(item_.length){

item_.click();

}


},

LoadData:function(cid_){

var container_=$("."+this.ContainerElement),
this_=this;

Preloaders.PutPreloader(container_);

$.post(Helpers.AjaxURL("LoadAddPost"),{cid:cid_},function(d){

var data_=GetResponse.Get(d);

if(data_){

this_.AfterResponse(container_,data_)

}


});

},


AfterResponse:function(container_,data_){

if(!data_.status){

container_.html(AlertMessage.GetContent(data_.message,"danger"));

}

else {

container_.html(data_.data);

this.OnAfterResponse(container_,data_);

}



},

OnAfterResponse:function(container_,data_){

this.ActivateStatusBox();

Helpers.FocusOnFirstInput(container_);

PostTokenInput.Init();

PostPreview.init();

},



};


var AccessControlCheck={

Init:function(message_){

if(!Globals.IsLoggedIn()){

CommonComponents.ToLoginPagePrompt(message_?message_:"Please log in to be able to perform this action.","warning");

return false;

}

return true;

}


};


var CheckPostOption={


	ModuleName:"Vote",

	Init:function(){

		var this_=this;

		$(document).on("click",Globals.PostOptionWrap,function(e){

		if(!AccessControlCheck.Init("Please log in to be able to vote on this post."))return false;

		if($(e.target).is(':radio') || $(e.target).is(':checkbox')){

			return;

		}

		var elm_=$(this).find("input[type=radio]");

		elm_.click();
		
		this_.OnSelect(elm_);

	});


	},

	OnSelect:function(radio_elm){

	var name_=radio_elm.attr("name"),
	option_id=$('input[name="'+name_+'"]:checked:first').val(),
	post_id=radio_elm.attr(Globals.PostIdAttribute),
	this_=this;
	
	$.post(Helpers.AjaxURL("Vote"),{option_id:option_id,post_id:post_id},function(d){

	var d_=GetResponse.Get(d);

	if(d_){
	
	this_.AfterResponse(d_,radio_elm);
	
	}

	});
	

	},

	AfterResponse:function(d_,elm_){

	if(d_.status){
	
	this.OnSuccess(d_,elm_);
	
	}

	else {
	
	//ModalAlert.Error(d_.message,"Error");
	console.log(d_.message);
	
	}

	},


	OnSuccess:function(d_,elem_){

	InsertIntoPostFeed.RefreshPost(elem_,d_.data);

	SetPostsGrid.Init();
	
	
	
	},


	CancelVote:function(elem_){

	var 	this_=this,
		post_id=Helpers.HasAttribute(elem_,Globals.PostIdAttribute)?elem_.attr(Globals.PostIdAttribute):0;

	if(post_id){
	
	Preloaders.PutPreloader(elem_);

	$.post(Helpers.AjaxURL("CancelVote"),{post_id:post_id},function(d){

	Preloaders.RemovePreloader(elem_);

	var d_=GetResponse.Get(d);

	if(d_){
	
	if(d_.status){
	
	AppNotifications.PutNoti(d_.message,this.ModuleName,"success");

	this_.OnSuccess(d_,elem_);
	
	}

	else {

	AppNotifications.PutNoti(d_.message,this.ModuleName,"danger");
	
	}
	
	
	}


	});
		
	
	}
	
	

	
	
	},
};




var CirclesRollover={

AppCircle:Globals.AppCircle,
CircleActions:".circle-actions",
DropDownClass:".dropdown",

Init:function(){

var this_=this;

$(document).on("mouseenter",this.AppCircle,function(){

this_.ToggleActions($(this),"show");

}).on("mouseleave",this.AppCircle,function(e){

this_.ToggleActions($(this));

});


}, 

ToggleActions:function(circle_elm,action_){

var actions_=circle_elm.find(this.CircleActions);

if(actions_.length){

if(action_=="show"){

Helpers.Show(actions_);

}

else {

Helpers.Hide(actions_);

this.HideDropDown(actions_);

}


}


},

HideDropDown:function(actions_elm){

var drop_d=actions_elm.find(this.DropDownClass);

if(drop_d.length && drop_d.hasClass("open")){

var a_=drop_d.find("a:first");

if(a_.length){

	a_.click();
}

}

},


};


var CirclesSlider={

SliderElement:".circles-slider-wrap",
SubSlideClass:".circle-wrap-li",
PointToCircleElement:Globals.PointToCircleElement,
PointerOrigin:Globals.PointerOrigin,
PreservedSliderInstance:false,
SliderContainer:Globals.UserCirclesContainer,

init:function(){

var container_=$(this.SliderElement);

if(container_.length){

var slides=container_.find(this.SubSlideClass);

if(slides.length){

var slider_=container_.bxSlider({
	adaptiveHeight:true,
	
});

this.PreservedSliderInstance=slider_;

return slider_;

}

else {

this.PointToAddCircles();

}

return false;

}

},

LoadSlider:function(){

var container_=$(this.SliderContainer),
    this_=this;

if(container_.length){

Preloaders.PutPreloader(container_);

$.post(Helpers.AjaxURL("GetCirclesSlider"),{flag:true,container_width:container_.width()},function(d){

Preloaders.RemovePreloader(container_);

var d_=GetResponse.Get(d);

if(d_ && d_.status){

container_.html(d_.data);

this_.init();

CSDefaultCircle.AutoLoadDefaultCircle();

}

else {

AppNotifications.PutNoti(d_.message+", re-trying....","Circles","danger");

this_.LoadSlider();

}

});

}

},


RemoveCircle:function(circle){

	var circle_=Helpers.IsObject(circle)?circle:LoadCircleData.CircleElementById(circle),
		this_=this;

		if(circle_.length){

			circle_.each(function(){

			var  $this=$(this),
				 par_li_=$this.parents("li:first"),
				circles_in_slide=par_li_.find(Globals.AppCircle).length;

				Helpers.HideThenRemove($this);

				if(circles_in_slide<=1){

					par_li_.remove();
					this_.SliderReload();

				}	


			});	
			
		}

},

SliderReload:function(){

	if(this.PreservedSliderInstance){

		this.PreservedSliderInstance.reloadSlider();

		return this.PreservedSliderInstance;
	}
	
	return false;

},

PointToAddCircles:function(){

var point_from=$(this.PointToCircleElement).find(this.PointerOrigin),
point_to=$(Globals.AddCircleButton);

if(point_from.length && point_to.length)
AppArrow.DrawBetweenElements(point_from,point_to);


},

SwitchToSlide:function(slide_index){

var slider_=this.PreservedSliderInstance;

if(slider_ && slider_.getSlideCount()>1 ){

slider_.goToSlide(slide_index);

return slider_.getCurrentSlide();

}


},

SwitchToLast:function(){

var slider_=this.init();

if(slider_){

slider_.goToSlide(slider_.getSlideCount()-1);

return slider_.getCurrentSlide();

}

},

UpdatePostCount:function(cid,count_){

	var cb_circle_elem=LoadCircleData.CircleElementById(cid),
	counter_=cb_circle_elem?cb_circle_elem.find(".main-circle-posts-count"):false,
	class_to_hide="d-hidden";

	if(counter_ && counter_.length){

	if(count_ && cid!=Globals.CurrentCircleId){

	counter_.html("+"+count_);

	counter_.removeClass(class_to_hide);
	
	}

	else {

	counter_.html("0");

	counter_.addClass(class_to_hide);
	
	}
	
	}
	
	},




};



var AppForgotPassword={

EmailElement:"#forgot-email",
ButtonElement:"#forgot-submit",
FormElement:"#forgot-password-form",

init:function(){

var form_=$(this.FormElement),
this_=this;

if(form_.length){

form_.submit(function(e){

	e.preventDefault();
	this_.CheckEmail();

});

}

},

CheckEmail:function(){

var this_=this,
btn_=$(this.ButtonElement),
email=$.trim($(this.EmailElement).val());

Preloaders.PutPreloader(btn_);

$.post(Helpers.AjaxURL("SendRestPasswordLink"),{email:email},function(d){

Preloaders.RemovePreloader(btn_);

var data_=GetResponse.Get(d);

if(data_){

	this_.AfterResponse(data_);
}

});



},

AfterResponse:function(data_){

var this_=this;

	if(!data_.status){

		AlertMessage.PutBox($(this_.FormElement),data_.message,"danger");

	}

	else {

	this_.OnSuccess(data_);

	}
},

OnSuccess:function(data){

var this_=this,
form_=$(this.FormElement);

AlertMessage.PutBox(form_,data.message,"success");

$(this.EmailElement).val("");

}

};

var ToogleElements={

	Elements:".toogle-class",
	ShowAttribute:"show-elm",
	HideAttribute:"hide-elm",

	init:function(){

		var this_=this;

		$(document).on("click",this.Elements,function(e){

			e.preventDefault();

			var $this=$(this);
			
			if(Helpers.HasAttribute($this,this_.ShowAttribute)){

				var show_elm=$($this.attr(this_.ShowAttribute));

				if(show_elm.length){

					Helpers.Show(show_elm);

				}


			}


			if(Helpers.HasAttribute($this,this_.HideAttribute)){

				var hide_elm=$($this.attr(this_.HideAttribute));

				if(hide_elm.length){

					Helpers.Hide(hide_elm);

				}


			}



		});
	},

};

var App_=App_ || {

config:{

SiteRoot: "BeHappyNew",
AjaxController: "Ajax",
ImagesDirectory:"static/images",
LoginURL:"site/login",
ResetPasswordURL:"site/ResetPassword",

},

init:function(){

AppSignIn.init();
AppSignUp.init();
this.InitLocals();
ToogleElements.init();
AppForgotPassword.init();
PasswordReset.init();
AppSignUpForm2.init();
CreateCircle.init();
AppComponents.init();
CirclesSlider.LoadSlider();
LoadCircleData.init();
StatusBox.init();
InvitePeopleToCircle.Init();
CheckPostOption.Init();
UploadPostImage.Init();
AddPostPopup.Init();
DeleteFeedPost.Init();
UploadCircleImage.Init();
AddCirclePopup.Init();
SendInvites.Init();
LoadMorePosts.Init();
CircleInvitesAction.Init();
BootstrapMenus.InitMenus();
RealTime.Init();
LikePosts.Init();
Comments.Init();
PeopleVoted.Init();
SetPostsGrid.Init();
ProfilePic.Init();
UpdateProfile.Init();
SendMessage.Init();
Inbox.Init();
Search.Init();
ScrollToTop.Init();
CirclesBar.Init();
CircleSettings.Init();
ContactUs.Init();
TopSearch.Init();
CSDefaultCircle.Init();
EditComment.Init();
JoinCircle.Init();
ReadMoreText.Init();
SharePost.Init();
NotificationAutoLoad.Init();
},

InitLocals:function(){

	this.FixHTMLTag();
	this.RunInLoopInit();
	this.FixDefaultCircleId();

},

ToRunInLoop:function(){

	this.FixHTMLTag();


},

RunInLoopInit:function(){

	var this_=this;

	var timer=setInterval(function(){

	this_.ToRunInLoop();
 	
	//SetPostsGrid.Init();
		

	},300);

},

FixHTMLTag:function(){

var html_t=$('html');

if(Helpers.HasAttribute(html_t,"style")){

html_t.removeAttr("style");

}

},

FixDefaultCircleId:function(){

var elem_=$(Globals.CircleDataContainerElement),
    attr_="circle-id";

if(elem_.length && Helpers.HasAttribute(elem_,attr_)){

Globals.CurrentCircleId=parseInt(elem_.attr(attr_));

}

}

};


var AppEffects=AppEffects || {


	SlideHide:function(elm_,callback_){

		this.Slide(elm_,"hide",'left',callback_);
	},

	Slide:function(elm_,show_hide,direction,callback_){
	
	var this_=this,
	args={direction: direction};

	if(show_hide=="show"){
	
	elm_.show('slide', args, 300,function(){
			
		this_.ManageCallback(callback_);

		});

	}

	else {
	
	elm_.hide('slide', args, 300,function(){
			
		this_.ManageCallback(callback_);

		});


	}


	},

	SlideShow:function(elm_,callback_){

		this.Slide(elm_,"show",'left',callback_);

	},

	ManageCallback:function(callback_){
	
	if(callback_){
			
		Helpers.ExecuteFunctionByName(callback_,window);

		}


	},

	Animate:function(elm_,animation_,animationDuration,rotate_angle){
		
		animationDuration=animationDuration?animationDuration:1200;

                    elm_.addClass('animated '+animation_);       
                    
                    setTimeout(function(){
                        elm_.removeClass(animation_);

                        if(rotate_angle){

                        	elm_.rotate(rotate_angle);
                        }

                    }, animationDuration);
               

},


};



$.fn.rotate = function(degrees, step, current) {
    var self = $(this);
    current = current || 0;
    step = step || 5;
    current += step;
    self.css({
        '-webkit-transform' : 'rotate(' + current + 'deg)',
        '-moz-transform' : 'rotate(' + current + 'deg)',
        '-ms-transform' : 'rotate(' + current + 'deg)',
        'transform' : 'rotate(' + current + 'deg)'
    });
    if (current != degrees) {
        setTimeout(function() {
            self.rotate(degrees, step, current);
        }, 5);
    }
};



var Helpers=Helpers || {

	SiteRoot:App_.config.SiteRoot,
	Root:window.location.origin,
	RootURL:function(){
                 
                var app_meta=GetResponse.Get(Globals.GetAppMeta());
                
                if(app_meta.root_url)return app_meta.root_url;
 
                var sub=this.Root.indexOf("localhost")!=-1 || this.Root.indexOf("127.0.0.1")!=-1?"/"+this.SiteRoot:"";
				return this.Root+sub;
	},

	"AjaxURL":function(action) {
    return this.RootURL() + "/"+App_.config.AjaxController+"/" + action;
	},

	Preloader:function(){

	return this.ImageTag(this.GetImage("preloaders/pl1.gif"));

	},

	Nl2Br:function(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	},

	Br2Nl:function(str){

        var regex = /<br\s*[\/]?>/gi;
         return str.replace(regex, "\n");

    },


	GetImage:function(img){

		return this.RootURL()+"/"+App_.config.ImagesDirectory+"/"+img;
	},

	ImageTag:function(src){

	return "<img src='"+src+"'/>";
},

	GetJson:function(d){

		var json_=d;

		if(this.IfJSONObject(json_)){

			return json_;
		}

		//recheck for Valid JSON object by parsing the received string as JSON
			json_=JSON.parse(d);

			if(this.IfJSONObject(json_)){

				return json_

			}

		return false;


	},

	IfJSONObject:function(json_){


		if (json_ && typeof json_ === "object" && json_ !== null) {

		 	return json_;
		 }

		 else {

		 	console.log("Seems to be invalid JSON object.");

		 	return false;
		 }



	},

	ReloadPage:function(){

		 location.reload(); 
	},

	ValidateEmail:function(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
	
	},

	Show:function(elm_){

		elm_.removeClass("none");
	},

	Hide:function(elm_){

		elm_.addClass("none");
	},

	HideThenRemove:function(elem_){

	elem_.hide("slow",function(){

		$(this).remove();
	});	


	},

Disable:function(elm_){

     elm_.attr('disabled','disabled').addClass("disable-click");

},

Enable:function(elm_){

     elm_.removeAttr('disabled').removeClass("disable-click");


},

ExecuteFunctionByName:function(functionName, context , args ) {
  var args = [].slice.call(arguments).splice(2);
  var namespaces = functionName.split(".");
  var func = namespaces.pop();
  for(var i = 0; i < namespaces.length; i++) {
    context = context[namespaces[i]];
  }
  return context[func].apply(this, args);
},

Guid: function () {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
},

PutFocus:function(elm_){

	elm_.focus();
},

HasAttribute:function(elm_,attr_){

var attr=elm_.attr(attr_);

return typeof attr !== typeof undefined && attr !== false;


},

GetParameterByName:function (name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
},


GetAbsoluteURL:function(url_){

return this.RootURL()+"/"+url_;

},

FormReset:function(form_){

form_.find("input,textarea").each(function(){

$(this).val("");

});


},

IsObject:function(obj_){

	return obj_ !== null && typeof obj_ === 'object';
},

IsImage:function(file_){

return file_.name.match(/\.(jpg|jpeg|png|gif|JPG|PNG|GIF|JPEG)$/);

},

FocusOnFirstInput:function(elm_){

var i_=elm_.find('input[type=text],textarea').filter(':enabled:visible:first');

if(i_.length) {

	this.SetCaretAtEnd(i_);

	}

},

ResponseMessage:function(msg,icon){

if(!icon) var icon="check";

return "<span class='response-msg'><i class='md md-"+icon+"'></i> "+msg+"</span>";

},

SetCaretAtEnd:function(elem) {

		elem=elem[0];//get the Javascript object	

        var elemLen = elem.value.length;
        // For IE Only
        if (document.selection) {
            // Set focus
            elem.focus();
            // Use IE Ranges
            var oSel = document.selection.createRange();
            // Reset position to 0 & then set at end
            oSel.moveStart('character', -elemLen);
            oSel.moveStart('character', elemLen);
            oSel.moveEnd('character', 0);
            oSel.select();
        }
        else if (elem.selectionStart || elem.selectionStart == '0') {
            // Firefox/Chrome
            elem.selectionStart = elemLen;
            elem.selectionEnd = elemLen;
            elem.focus();
        } 
    },

    AttributeSupported:function(attribute){
       return (attribute in document.createElement("input"));
    },


    GetMetaData:function(tag_name){

    	var elem= $('meta[name='+tag_name+']');

    	return elem.length?elem.attr("content"):0;
    },

    FirstWordUpperCase:function(t_){

	var text_=$.trim(t_).charAt(0).toUpperCase() + t_.slice(1);
	
	return text_.length?text_:t_;
	
	},

	

};

var Preloaders=Preloaders || {


	PreloaderClass:"preloader-div",
	PreloaderAttr:"app-preloader",

	PutPreloader:function(elm_,text){

		
		if(this.IfAttributePreloader(elm_)){

		this.AttrPreloader(elm_,text);	

		}

		else if(elm_.is("div") || elm_.is("li")){

		this.DivPreloader(elm_,text);	

		}

		else {

		this.ButtonPreloader(elm_,text);	

		}

	
	},

	AttrPreloader:function(elm_,text){

		var action_=elm_.attr(this.PreloaderAttr);

		if(action_=="append"){

		elm_.append(this.PreloaderContent());

		}

		else {

		elm_.prepend(this.PreloaderContent());


		}

		Helpers.Disable(elm_);

	},

	ButtonPreloader:function(elm_,text){

		elm_.after(this.PreloaderContent());
		
		Helpers.Disable(elm_);	
	
		this.PutText(elm_,text);

	},

	IfAttributePreloader:function(elem){

	return Helpers.HasAttribute(elem,this.PreloaderAttr);


	},	

	DivPreloader:function(elm_,text){

		if(!elm_.find("."+this.PreloaderClass).length){

		elm_.html(this.PreloaderContent(text))

	}

	},

	PreloaderContent:function(text_){

	return 	"<div class='"+this.PreloaderClass+"'>"+Helpers.Preloader()+ (text_?text_:"") + "</div>";


	},

	RemovePreloader:function(elm_,text){

		if(elm_.is("div") || this.IfAttributePreloader(elm_) ){

			this.RemoveFromDiv(elm_,text);
		}
		

		else {

			this.RemoveFromButtuon(elm_,text);
		}
	},

	RemoveFromDiv:function(elm_,text){

		var preloader_=elm_.find("."+this.PreloaderClass+":first");

		if(preloader_.length){

			preloader_.remove();

			Helpers.Enable(elm_);
		}
	},

	RemoveFromButtuon:function(elm_,text){

		var pl_elm=elm_.next();

		if(pl_elm.hasClass(this.PreloaderClass)){

			pl_elm.remove();
		}

		Helpers.Enable(elm_);

		this.PutText(elm_,text);

	},

	PutText:function(elm_,text_){

		if(text_){

			elm_.html(text_);
		}

	},


};



var AppSignIn={

"FormElement":"#login-nav",
"EmailElement":"#login-email",
"PasswordElement":"#login-password",
"RememberElement":"#login-remember",
"SubmitElement":"#login-submit",
init:function(){
var this_=this,
form_=$(this.FormElement);

if(form_.length){

form_.submit(function(event){
event.preventDefault();
if(!FormValidate.Init($(this))){return;}
this_.FormValidate();
});

}


},

FormValidate:function(){

var email=$.trim($(this.EmailElement).val()),
password=$.trim($(this.PasswordElement).val()),
remember=$(this.RememberElement).is(":checked")?$(this.RememberElement).val():"",
submit_btn=$(this.SubmitElement),
text_=submit_btn.html(),
this_=this;

Preloaders.PutPreloader(submit_btn,"Signing in....");

$.post(Helpers.AjaxURL("Login"),{email:email,password:password,remember:remember},function(d){

Preloaders.RemovePreloader(submit_btn,text_);

this_.AfterResponse(d);

});

},

AfterResponse:function(d){

var data=GetResponse.Get(d);

if(data){

this.CheckLogin(d);

}

},

CheckLogin:function(d){

if(d.status){

var app_meta=GetResponse.Get(Globals.GetAppMeta());

if(app_meta.controller=="pages"){

window.location= Helpers.RootURL();

}

else 
Helpers.ReloadPage();

}

else {


	var elm_=$(this.FormElement);

	AlertMessage.PutBox(elm_,d.message,"danger");

	$(this.PasswordElement).val("").focus();

}

}


};


var GetResponse=GetResponse || {

Get:function(response_){

var data=Helpers.GetJson(response_);

if(!data){

ModalAlert.Error("Error: Invalid data received from server");

return false;
}

return data;



}


};


var ModalAlert=ModalAlert || {

	Error:function(message_,title_){


		this.SetupModal(AlertMessage.GetContent(message_,"danger"),title_);
	},

	Success:function(message_,title_){

		this.SetupModal(AlertMessage.GetContent(message_,"success"),title_);
	},

	SetupModal:function(message_,title_,overlay_click_close){


		var id_=Helpers.Guid(),
		title_=title_?title_:"Alert",
		this_=this,
		customModal='<div class="modal fade left" id="'+id_+'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bgm-blue c-white"><button type="button" class="close c-white bold" title="Close" data-dismiss="modal">&times;</button><h4 class="modal-title c-white">'+title_+'</h4></div><div class="modal-body">'+message_+'</div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div> </div>',
		modal_conf=overlay_click_close?{backdrop: 'static', keyboard: false}:{};

		$('body').append(customModal);

		$("#"+id_).modal(modal_conf).on('hidden.bs.modal', function () {

		$(this).remove();
		
		this_.OnClose();
    	
    		});

		return $("#"+id_);


	},

	OnClose:function(){

	PostPreview.Destroy();
	
	},

	CloseAll:function(){

	$('.modal.in').modal('hide');

	},

	

};


var AlertMessage=AlertMessage || {

AlertBoxClass:"app-alert-box",
PutBox:function(elm_,message_,type_){

this.RemoveBox(elm_);

this.CreateBox(elm_,message_,type_);


},

CreateBox:function(elm_,message_,type_){

var content_=this.GetContent(message_,type_);

elm_.prepend(content_);

return elm_;

},

GetContent:function(message_,type_){

return '<div class="alert alert-'+type_+' '+ this.AlertBoxClass+'" role="alert"> '+message_+'</div>';

},

RemoveBox:function(elm_){

var Abox_=elm_.find("."+this.AlertBoxClass);

if(Abox_.length){

	Abox_.remove();
}

},

};


var AppSignUp={

	"FormElement":"#signup-form-step-1",
	"EmailElement":"#signup-email",
	"ButtonElement":"#signup-button",
	"ButtonDefaultText":"Sign Up",
	"EmailValue":"",
	"PasswordElement":"#signup-password",
	"FormElement2":"#signup-form-step-2",
	"CommonClass":".signup-form",

	init:function(){

		var signup_form=$(this.FormElement),
		this_=this;

		if(signup_form.length){

			signup_form.submit(function(e){

				e.preventDefault();
				if(!FormValidate.Init($(this))){

				return;
				}

			});

		this.ButtonDefaultText=$(this.ButtonElement).html();
		this.SetUp();

		}


	},

	SetUp:function(){

		this.EmailFieldSetup();
		this.ButtonSetUp();
	},


EmailFieldSetup:function(){


	var this_=this;

		$(this_.EmailElement).bind("keyup change",function(){

			var val_=$.trim($(this).val()),
			btn_=$(this_.ButtonElement);

			this_.EmailValue=val_;

			if(Helpers.ValidateEmail(val_)){

				btn_.html("Next");
				
			}

			else {

				btn_.html(this_.ButtonDefaultText);
			}

		});

},

FinalButtonSetup:function(){

var this_=this;

$(this.FormElement2).submit(function(e){

e.preventDefault();

var email=$.trim($(this_.EmailElement).val()),
password=$.trim($(this_.PasswordElement).val());

if(!password.length){

	ModalAlert.Error("Please enter a valid password.","Sign Up");

	return false;
}

else {

this_.Register(email,password);

}


});

},

Register:function(email,passwd){

var btn_=$(this.FormElement2).find("[type=submit]"),
this_=this;

Preloaders.PutPreloader(btn_,"Registering.....");

$.post(Helpers.AjaxURL("Register"),{email:email,password:passwd},function(d){

Preloaders.RemovePreloader(btn_,"Register");

var d_=GetResponse.Get(d);

if(d){

this_.AfterResponse(d);

}

});

},

AfterResponse:function(data_){

if(data_.status){

  $(this.CommonClass).hide();

	CommonComponents.ToContinuePagePrompt(Globals.SignUpSuccessMessage,"success");

	//Helpers.ReloadPage();
}

else {

	ModalAlert.Error(data_.message,"Sign Up");

}

},

CheckTheEmail:function(email){

var this_=this,
btn_=$(this_.ButtonElement),
text_=btn_.html();

Preloaders.PutPreloader(btn_,"Checking email.....");

$.post(Helpers.AjaxURL("IsRegistered"),{email:email},function(d){

Preloaders.RemovePreloader(btn_,text_);

var data=GetResponse.Get(d);

if(data ){

if(data.status){

//ModalAlert.Error(data.message,"Sign Up");

ModalAlert.SetupModal(AlertMessage.GetContent(data.message,"danger")+"<div class='right'><a href='"+Helpers.GetAbsoluteURL(App_.config.LoginURL)+"' class='small'>Login</a>&nbsp; | &nbsp; <a class='small' href='"+Helpers.GetAbsoluteURL(App_.config.ResetPasswordURL)+"'>Forgot password?</a></div>","Sign Up");


}

else {

this_.SwithToPasswordForm();
this_.FinalButtonSetup();


}

}

});

},


SwithToPasswordForm:function(){

var this_=this;

$(this_.FormElement).hide('slide', {direction: 'left'}, 300,function(){

var form2_=$(this_.FormElement2);

Helpers.Show(form2_);

AppEffects.SlideShow(form2_);

Helpers.PutFocus($(this_.PasswordElement));

});

},


ButtonSetUp:function (){

	var this_=this;

	$(this_.ButtonElement).click(function(){

		if(Helpers.ValidateEmail(this_.EmailValue)){

		this_.CheckTheEmail(this_.EmailValue);


		}

	});
},


};


var PasswordReset={


	FormElement:"#reset-pswd-form",
	PassworElement:"#reset-pswd",
	RepeatPasswordElement:"#reset-pswd-repeat",
	ButtonElement:"#reset-pswd-btn",

	init:function(){

		var this_=this;

		if($(this_.FormElement).length){

			$(this_.FormElement).submit(function(e){

				e.preventDefault();

				if(!FormValidate.Init($(this))){

				return;
				}

				this_.HandleData();


			});

		}
	},

	HandleData:function(){

		var password=$.trim($(this.PassworElement).val()),
		repeat_password=$.trim($(this.RepeatPasswordElement).val()),
		this_=this,
		form_=$(this.FormElement),
		btn_=$(this_.ButtonElement);

		if(password!=repeat_password){

			AlertMessage.PutBox(form_,"Sorry, passwords don't match.","danger");
			Helpers.PutFocus($(this.RepeatPasswordElement));

		}

		else {

		Preloaders.PutPreloader(btn_);

		$.post(Helpers.AjaxURL("ResetPassword"),{password:password,hash:Helpers.GetParameterByName('uh_')},function(d){

		Preloaders.RemovePreloader(btn_);	

		var data_=GetResponse.Get(d);
		
		if(data_){

				this_.AfterResponse(data_);

		}	

		});

	}


	},

	AfterResponse:function(data_){

		if(data_.status){

			CommonComponents.ToLoginPagePrompt(data_.message,"success");

			CommonComponents.CleanForm($(this.FormElement));


		}

		else {

			AlertMessage.PutBox($(this.FormElement),data_.message,"danger")

		}

	}



};

var AppSignUpForm2={

FormElement:"#signup-page-form",
EmailElement:"#signup-page-email",
MobileElement:"#signup-page-mobile",
PasswordElement:"#signup-page-password",
ButtonElement:"#signup-page-submit",
CheckboxElement:"#signup-page-agreement-ch",

init:function(){

var this_=this;

if($(this_.FormElement).length){

$(this_.FormElement).submit(function(e){

e.preventDefault();

if(!FormValidate.Init($(this))){

				return;
			}

this_.HandleForm();


});

}

},

HandleForm:function(){


var this_=this,
email=$.trim($(this_.EmailElement).val()),
password=$.trim($(this_.PasswordElement).val()),
mobile=$.trim($(this_.MobileElement).val()),
btn_=$(this_.ButtonElement);

Preloaders.PutPreloader(btn_);

$.post(Helpers.AjaxURL("Register"),{email:email,password:password,mobile:mobile},function(d){

Preloaders.RemovePreloader(btn_);

var data_=GetResponse.Get(d);

if(data_)
this_.AfterResponse(data_);

});

},

AfterResponse:function(data_){


if(data_.status){

CommonComponents.ToContinuePagePrompt(Globals.SignUpSuccessMessage,"success");

CommonComponents.CleanForm($(this.FormElement));

}


else {

AlertMessage.PutBox($(this.FormElement),data_.message,"danger");

}

},


};


//Signup from social app
AppSignUpSocial={

Signup:function(email,firstname,lastname,profile_pic,id,website){

$.post(Helpers.AjaxURL("RegisterSocial"),{email:email,name:firstname+" "+lastname,password:'social_website',profile_pic:profile_pic,id:id,website:website},function(d){
window.location.reload();
//Preloaders.RemovePreloader(btn_);
//var data_=GetResponse.Get(d);
//console.log(data_);
//return;
//if(data_)
//this_.AfterResponse(data_);
});

},

AfterResponse:function(data_){


if(data_.status){

CommonComponents.ToContinuePagePrompt(Globals.SignUpSuccessMessage,"success");

CommonComponents.CleanForm($(this.FormElement));

}


else {

AlertMessage.PutBox($(this.FormElement),data_.message,"danger");

}

},


};


var CreateCircle={


FormElement:".create-circle-form",
TitleElement:".circle-create-title",
ButtonElement:".circle-create-btn",
PrivacyElement:".c-visibility",

init:function(){

var this_=this;

$(document).on("submit",this_.FormElement,function(e){
e.preventDefault();

this_.HandleForm($(this));

});

},

HandleForm:function(form_){

var this_=this,
input_=form_.find(this_.TitleElement),
title_=$.trim(input_.val());

if(!title_.length){

AlertMessage.PutBox(form_,"Please enter the title","danger");
input_.focus();

}

else {

AlertMessage.RemoveBox(form_);

this_.CreateCircle(title_,form_);

}

},

CreateCircle:function(title_,form_){

var this_=this,
btn_=form_.find(this_.ButtonElement),
text_=btn_.text(),
image=$(Globals.CircleImageNameField),
privacy=form_.find(this_.PrivacyElement).val();


Preloaders.PutPreloader(btn_,"Creating....");

$.post(Helpers.AjaxURL("CreateCircle"),{title:title_,circle_image:image.length?image.val():"",privacy:privacy,container_width:Globals.GetCirclesContainerWidth()},function(d){

Preloaders.RemovePreloader(btn_,text_);

var data_=GetResponse.Get(d);

if(data_){

this_.AfterResponse(data_,form_);


}

});

},

AfterResponse:function(data_,form_){

if(data_.status){

PushCircle.init(data_.data);

CommonComponents.CleanForm(form_);

CirclesBar.LoadBar();

AppNotifications.PutNoti(data_.message,"Circle","success");

ModalAlert.CloseAll();

//FormToggleHide.init(form_,data_.message,"success");

}

else {

AlertMessage.PutBox(form_,data_.message,"danger");

}

}

};

var PushCircle={

ContainerElement:Globals.UserCirclesContainer,

init:function(circle_html_){

var container_=$(this.ContainerElement);

if(container_.length && circle_html_){

container_.html($(circle_html_));

AppArrow.Destroy();

this.AfterAppend();

}

},

CircleEffect:function(circle_){

AppEffects.Animate(circle_,"bounceInDown",false,360);

},

AfterAppend:function(){

CirclesSlider.SwitchToLast();

var elm_=$(this.ContainerElement).find(".circle-wrap-li:nth-last-child(2)").find(Globals.AppCircle+":last");

if(elm_.length){

this.CircleEffect(elm_);

}

},

};


var FormToggleHide={

init:function(form_,message,type_){

if(form_){

this.ShowHideFormElements(form_);

AlertMessage.PutBox(form_,message,type_);

this.PutHideButton(form_);

}

},


PutHideButton:function(form_){

var btn_=$("<button class='btn btn-danger'>Create More</button>");

form_.append(btn_);

this.ButtonClick(btn_,form_);

},

ButtonClick:function(btn_,form_){

var this_=this;

btn_.click(function(e){

e.preventDefault();

$(this).hide(1,function(){

$(this).remove();

});

this_.ShowHideFormElements(form_,"show");

AlertMessage.RemoveBox(form_);


});

},


ShowHideFormElements:function(form_,action_){

var elements_=this.GetFormElements(form_);

if(elements_.length){

for(n in elements_){

if(!action_ || action_=='hide')
Helpers.Hide(elements_[n]);

else {

Helpers.Show(elements_[n]);


}

}

}

},


GetFormElements:function(form_){

var inputs_=form_.find("input"),
buttons=form_.find("button"),
array_=new Array();

if(inputs_.length){

inputs_.each(function(){

array_.push($(this));

});

}

if(buttons.length){

buttons.each(function(){

array_.push($(this));

});

}

return array_;



},

};


var CommonComponents={

ToContinuePagePrompt:function(msg,type_){

var content_=AlertMessage.GetContent(msg,type_)+"<div><a href='"+Helpers.RootURL()+"' class='btn btn-warning btn-lg'>Continue</a></div>";

ModalAlert.SetupModal(content_,"Continue");

},

ToLoginPagePrompt:function(msg,type_){

var content_=AlertMessage.GetContent(msg,type_)+"<div><a href='"+Helpers.GetAbsoluteURL(App_.config.LoginURL)+"' class='btn btn-warning'>Log In</a></div>";

ModalAlert.SetupModal(content_,"Log In");


},


CleanForm:function(form_){

AlertMessage.RemoveBox(form_);

Helpers.FormReset(form_);


}

};


var LoadCircleData={

CircleElement:Globals.AppCircle,
CIDAttribute:Globals.CIDAttribute,
ContainerElement:Globals.CircleDataContainerElement,
ActiveClass:"app-circle-active",


init:function(){

var this_=this;

$(document).on("click touchend",this_.CircleElement,function(e){

var $this=$(this);

if(Helpers.HasAttribute($this,this_.CIDAttribute)){

var cid_=$this.attr(this_.CIDAttribute);

if(cid_.length){

this_.LoadData(cid_,$this);

}

}

else {

	ModalAlert.Error("Sorry, data for this circle can't be loaded.")
}

});

},


MakeActive:function(circle_elm){

if(circle_elm){

var this_=this;

$(this_.CircleElement).removeClass(this_.ActiveClass);

circle_elm.addClass(this_.ActiveClass);

this_.SwitchToActiveSlide(circle_elm);

}

},

SwitchToActiveSlide:function(circle_elm){

	var par_li=circle_elm.parents("li:first");

	CirclesSlider.SwitchToSlide(par_li.index()-1);


},

CircleElementById:function(cid_){

var elem_=$(this.CircleElement+"["+this.CIDAttribute+"="+cid_+"]");

return elem_.length?elem_:false;

},

MakeCircleActive:function(cid){

var circle_=this.CircleElementById(cid);

if(circle_.length){

return this.MakeActive(circle_);

}

},

LoadData:function(cid_,circle_elm){

var cid_=parseInt(cid_),
this_=this,
circle_elm=circle_elm?circle_elm:this_.CircleElementById(cid_),
container_=$(this_.ContainerElement);

if(cid_ && container_.length){

this_.MakeActive(circle_elm);

CirclesBar.MakeCircleActive(cid_);

Globals.CurrentCircleId=cid_;

RealTime.Abort();

LoadMorePosts.Abort();

Preloaders.PutPreloader(container_);

PostPreview.Destroy();

$.post(Helpers.AjaxURL("GetCircleData"),{cid:cid_},function(d){

RealTime.Resume();	

LoadMorePosts.Resume();

Preloaders.RemovePreloader(container_);

var data_=GetResponse.Get(d);

if(data_){

	this_.AfterResponse(data_, container_);
}

});

}


},

AfterResponse:function(data_, container_){

if(data_.status){

container_.html(data_.data);

this.OnAfterResponse(container_);

}

else {

AlertMessage.PutBox(container_,data_.message,"danger");

}

},

OnAfterResponse:function(container_){

SetPostsGrid.Init();

LoadMorePosts.Init();

ScrollToStatusBox.init();

CirclesBar.FixSideBar();

},


};


var InsertIntoPostFeed={

	PostsContainer:Globals.PostsGridContainer,
	NoPostsElement:".no-posts-msg",
	ContainerElement:Globals.CirclePostWrap,

	Init:function(content_,action_,disable_scroll){

		var container_=$(this.PostsContainer),
			content_to_push=$($.trim(this.GetContentToPush(content_)));

		if(container_.length && content_to_push.length){

			if(!action_ || action_=="prepend"){

				container_.prepend(content_to_push);

				if(!disable_scroll){
				
				this.AfterPrepend();
				
				}

			}

			else {

				container_.append(content_to_push);

			}


			this.AfterInsert(content_to_push);

		}



	},

	GetContentToPush:function(data_){

	if(data_.constructor===Array && data_.length){

	return this.PushMultiple(data_);

	}

	else{

	return data_;

	}


	},


	PushMultiple:function(data_){

	var final_="";

	for(i in data_){

	var elem=$(data_[i]);

	if(!$("#"+elem.attr("id")).length){

	final_+=data_[i];

	}

	}

	return final_;


	},

	AfterPrepend:function(){

	AppEffects.Animate($(Globals.CirclePostWrap+":first"),"highlight",500);	

	ScrollToStatusBox.init();

	},


	RemoveNoPostsMsg:function(){

		var elem_=$(this.NoPostsElement);

		if(elem_.length){

		elem_.remove();	

		}

	},


	AfterInsert:function(content_){

		this.RemoveNoPostsMsg();

		SetPostsGrid.Init();

		this.ContinueGridSetup();

	},

	
	ContinueGridSetup:function(){

	 var started_=0,
	 	 limit=10000,	

	 timer_=setInterval(function(){

	 	if(started_>=limit){

	 		clearInterval(timer_);
	 	}

	 	SetPostsGrid.Init();

	 	started_+=300;

	 },300);	

	 },

	FirstPostId:function(){

	var p_=$(this.ContainerElement+":first"),
	    attr_="p-id";

	if(p_.length && Helpers.HasAttribute(p_,attr_)){

	return p_.attr(attr_);

	}

	return 0;

	},

	RefreshPost:function(elem_,data_){

	var container_=elem_.parents(Globals.CirclePostWrap+":first");

	if(container_.length){

	container_.html($(data_).html());	

	}
	
	},

};


var Grid={


GridClass:"masonary-grid",

Init: function(container_,itemSelector,gutter){

	if(container_.hasClass(this.GridClass)){

	if(container_.is(":visible"))	
	this.Refresh(container_);

	}

	else {

		container_.addClass(this.GridClass);

		var $m=container_.masonry({
        itemSelector: itemSelector,
		isAnimated: false,
		transitionDuration:0,
		gutter: gutter?gutter:false,
		percentPosition: true,

   		});

		this.RefreshGridsOnImageLoad(container_)

		return $m;


	}


},

ReFreshGridInIntervals:function(container){
	
	var this_=this,
		total_sec=60,
		counter_=0,
	timer_=setInterval(function(){
	this_.Refresh(container);	
	counter_+=2;
	
	if(counter_>=total_sec){
		clearInterval(timer_);
	}
	},2000);
},

RefreshGridsOnImageLoad:function(container){

		var imgs=container.find(".lightbox-item img"),
		    this_=this;

		if(imgs.length){

			imgs.each(function(){

				if(!this.complete){

					$(this).load(function(){

					this_.Refresh(container);	

					});
				}

		   });
		}

	},


Refresh:function(container_){

container_.masonry('reloadItems').masonry('layout');

//this.RefreshGridsOnImageLoad(container_);

}

};


var SetPostsGrid={

Init:function(){

var container_=$(Globals.PostsGridContainer),
    this_=this;

if(container_.length && $(Globals.CirclePostWrap).length){

	Grid.Init(container_,Globals.CirclePostWrap,10);

}

Search.SetupGrid();

},

Refresh:function(){

Grid.Refresh($(Globals.PostsGridContainer));

},


};


var PostTokenInput={

InputElement:"#sst-options-field",
DefaultOptionAttr:"default-options",
MaxAllowedAttr:"max-allowed",

Init: function(){

var elm_=$(this.InputElement),
this_=this,
max_allowed=parseInt(elm_.attr(this.MaxAllowedAttr));

if(elm_.length){

	    elm_.tokenInput((!isMobile.iOS()?Helpers.AjaxURL("SearchPostOptions"):[]), {
                theme: "facebook",
                hintText:"Type a new Option here",
		tokenDelimiter:null,

prePopulate:this_.DefaultOptions(elm_),
zindex: 9999,

 tokenLimit:max_allowed,
 resultsFormatter:function(item){

					 	return "<li>"+Helpers.FirstWordUpperCase(item.name)+"</li>";

					 },
    onResult: function (item) {
        if($.isEmptyObject(item)){
              return [{id:'0',name: Helpers.FirstWordUpperCase($("tester").text())}]
        }else{
        	        	item.unshift({id:'0',name: Helpers.FirstWordUpperCase($("tester").text())});

              return item
        }

    },

    onAdd: function (item) {
                    
                    PostPreview.UpdatePostPreview(true);
                },
                onDelete: function (item) {
                                        PostPreview.UpdatePostPreview(true);

                },


            });
}


},


DefaultOptions:function(input_){


if(Helpers.HasAttribute(input_,this.DefaultOptionAttr)){

	var options_=Helpers.GetJson(JSON.parse(input_.attr(this.DefaultOptionAttr)));

	if(options_) return options_


}


return [];

},

GetValues:function(){

return $(this.InputElement).tokenInput("get");

},


};



var ScrollToStatusBox={

	ContainerElement:Globals.CircleDataWrap,

	init:function(){

		var container_=Globals.GetCircleDataContainer();

		if(container_){

			var scroll_to=container_.find(this.ContainerElement);

			if(scroll_to){

				this.ScrollTo(scroll_to);
				
			}

		}

		

	},


	ScrollTo:function(scroll_to_elm,scroll_elm){

		if(!scroll_elm){

			var scroll_elm=$(document);

		}

			scroll_elm.scrollTo(scroll_to_elm,500,{

				offset:-170
			});

	},
};


var ElementPointer={



init:function(from_elm,to_elm){

var starting_points=from_elm.offset(),
end_points=to_elm.offset();

var canvas_width=Math.abs(end_points.left-(starting_points.left+from_elm.width()));


console.log(starting_points);
console.log(end_points);

AppArrow.Draw(starting_points.top,starting_points.left,end_points.top,end_points.left);

return;

 	// initialize pointy (showing all options; but not all defaults)
   return to_elm.pointy({
      pointer      : from_elm,
      arrowWidth   : 10, // width of pointer base
      borderWidth  : 1,  // pointer stroke width
      defaultClass : '', // additional class name added to the pointer & the arrow (canvas)
      activeClass  : 'pointy-active', // class added to base & pointer on updating,
      //flipAngle    : 350,  

      // optional; if not set, plugin will attempt to match the base color
      borderColor     : null,
      backgroundColor : null,

      // tweaks
      useOffset : null
    });






},

RemovePointer:function(elm_){

var el_=elm_?elm_:Globals.PointyObject;

if(el_){

el_.data('pointy-destroy');

}

}


};


var StatusBox={

Container:'#add-tl-item',


init:function(){	
	
	this.InitAdditem();
	this.InitActions();

},


InitAdditem:function(){

$('body').on('click', this.Container +' .add-new-item', function(){
 
   	    $(this).parent().addClass('toggled'); 
    	
	});
 
},

InitActions:function(){

var this_=this;

$('body').on('click', '.btn-save-status', function(e){

PostPreview.Destroy();

this_.SaveStatus($(this));

});

/*$('body').on('click', '.add-tl-actions > button', function(e){
  

              e.preventDefault();

                var x = $(this).closest(this_.Container);
                var y = $(this).data('tl-action');

		PostPreview.Destroy();
                            
                if (y == "dismiss") {
                   this_.Close();
                }
                
                if (y == "save") {
                    
		    		this_.SaveStatus($(this));
		
                }
    	});*/

},

ValidatedContent:function(){

var content_=PostPreview.GetInputContent();

if(content_){

return content_.supporting_text.length || content_.content.length ? content_:false;

}

return false;

},


SaveStatus:function(btn_){

var content_=this.ValidatedContent();

if(!content_){

ModalAlert.Error("Please type the question or its description.","Post is empty");

//this.Close();

}

else {


	this.SaveInit(content_,btn_)
}

},

SaveInit:function(content_,btn_){

var this_=this,
cid_=btn_.attr(Globals.CIDAttribute),
original_text=btn_.html();

Preloaders.PutPreloader(btn_,"Creating...");

$.post(Helpers.AjaxURL("SaveStatus"),{content:JSON.stringify(content_),cid:cid_},function(d){

Preloaders.RemovePreloader(btn_,original_text);

var data_=GetResponse.Get(d);

if(data_){

	this_.AfterResponse(data_);
}


});

},

AfterResponse:function(data_){

if(data_.status){

Helpers.FormReset($(this.Container));

ModalAlert.CloseAll();

AppNotifications.PutNoti(data_.message,"Status","success");

InsertIntoPostFeed.Init(data_.data);

//PutPost.init(data_.data);

}

else {

ModalAlert.Error(data_.message);

}

},

Close:function(){


var x = $(this.Container);

if(x.length){

x.removeClass('toggled'); 

}

}

};


var PutPost={

	ContainerElement:Globals.CirclePostWrap,
	PostFeedCoulmn:	Globals.PostFeedCoulmn,

	init:function(post_data,scroll_){

	var container_=	this.GetContainer();

	if(post_data.length){

	this.Push(container_,post_data,scroll_);

	}

	},


	Push:function(container_,data_,scroll_){

	if(container_){
	
	var d_=this.GetContentToPush(data_);

	if($.trim(d_.length)){
	
	container_.prepend(d_);
	
	}
	
	SetPostsGrid.Init();

	if(!scroll_){
	
	ScrollToStatusBox.init();

	AppEffects.Animate(data_,"bounceInDown");
	
	}

	
	}
	
},

GetContentToPush:function(data_){

if(data_.constructor===Array && data_.length){

	return this.PushMultiple(data_);

	}

	else{

	return data_;

	}


},


PushMultiple:function(data_){

var final_="";

for(i in data_){

var elem=$(data_[i]);

if(!$("#"+elem.attr("id")).length){

final_+=data_[i];

}

}

return final_;


},


GetContainer:function(){

var container_= $(Globals.PostsGridContainer);

if(container_.length){

	return container_;

	var child_=container_.find(this.ContainerElement+" "+this.PostFeedCoulmn+":first");

	if(child_.length) return child_
}

return false;

},

FirstPostId:function(){

var p_=$(this.ContainerElement+":first"),
    attr_="p-id";

if(p_.length && Helpers.HasAttribute(p_,attr_)){

return p_.attr(attr_);

}

return 0;

}

};

var PostPreview={

ContainerElement:"."+Globals.AddPostContainer,
PointerToElement:".sst-content-div",
InputElement:".sst-content",
PopOverId:"status-preview-popover",
ContentInput:".status-main-content",
PopOverContentElement:"popover-content",
StatusSupportingTextElement:".status-supporting-text",
StatusContentElement:".status-content",


Triggerers:function(){
return [this.InputElement,this.ContentInput];
},


	init:function(){

		if(!isMobile.any()){

		var point_to=this.GetPointerElement();

		if(point_to.length){

			var input_=point_to.find(this.InputElement);

			if(input_.length){

			this.TriggerPopOver(input_);	

			}
		}

	}

	},

	TriggerPopOver:function(input_){

		var this_=this,
		triggerers=this_.Triggerers();

		for(i in triggerers){

			var elm_=$(triggerers[i]);

			if(elm_.length){

				this_.SetupKeyEvent(elm_);

			}

		}

		
	},

	BuildPopover:function(){


		var popover=$("#"+this.PopOverId);

			if(!popover.length){

			popover=this.CreatePopOver();

			}

			return popover;

	},

	SetupKeyEvent:function(elm_){

		var this_=this;


		function common_action(){

			this_.UpdatePopOver(this_.BuildPopover());
		}

		function popover_exists(){

		return $("#"+this_.PopOverId).length;	

		}

		elm_.keyup(function(e){
			
			var text_=Helpers.FirstWordUpperCase($(this).val());

			$(this).val(text_);

			common_action();

		});


		$(window).scroll(function(){
			if(popover_exists())common_action();
		}).resize(function(){
			if(popover_exists())common_action();
		});



	},

	GetInputContent:function(){

		var par_=$(this.ContainerElement),
		 supporting_text=par_.find(this.InputElement),

			content=par_.find(this.ContentInput);

			if(supporting_text.length && content.length){

				return {

					"supporting_text":$.trim(supporting_text.val()),
					"content":$.trim(content.val()),
					"options":PostTokenInput.GetValues(),
					"post_image":UploadPostImage.GetUploadedFileName(),


				};
			}

			return false;
	},


	UpdatePopOver:function(popover_){


		var content_=this.GetInputContent(),
		destroy_=false;


		if(Helpers.IsObject(content_)){

			destroy_=!content_.supporting_text.length && !content_.content.length;

		}

		if(destroy_){

			this.Destroy();
		}


		else {


			this.UpdatePreview(content_,popover_);

		}	

	},


	UpdatePostPreview:function(from_server){

		if(!isMobile.any())
		this.UpdatePreview(this.GetInputContent(),this.BuildPopover(),from_server);

	},

	UpdatePreview:function(content_,popover_,from_server){

		var popover_content=popover_.find("."+this.PopOverContentElement);

		if(popover_content.length){

			if(!$.trim(popover_content.html()).length || from_server){

				this.UpdateFromServer(popover_content,content_);
			}

			else {

				this.UpdateFromClient(content_,popover_);

			}

		}
		
	},


	UpdateFromServer: function(popover_content,content_){

		Preloaders.PutPreloader(popover_content);

				$.post(Helpers.AjaxURL("PreviewPost"),{content:JSON.stringify(content_)},function(d){

					data_=GetResponse.Get(d);

					if(data_ && data_.status){

						popover_content.html(data_.data);

					}

				});


	},

	UpdateFromClient:function(content_,popover_){

		var supporting_text=popover_.find(this.StatusSupportingTextElement),
		content_elm=popover_.find(this.StatusContentElement);

		if(supporting_text.length && content_elm.length){

			supporting_text.html(content_.supporting_text);
			content_elm.html(Helpers.Nl2Br(content_.content));
			this.FixPosition(popover_);
			AppEffects.Animate(popover_,"bounce");

		}


	},


	GetPointerElement:function(){

		return $(this.ContainerElement).find(this.PointerToElement);
	},


	CreatePopOver:function(){

		var content_=$(this.PopOverContent(this.PopOverId));

		$('body').append(content_);

		AppEffects.Animate(content_,"bounce");

		this.FixPosition(content_);

		return content_;

	},

	FixPosition:function(popover_){

		var point_to=this.GetPointerElement();

		if(point_to.length){

			var pos=point_to.offset();

			popover_.css({"position":"absolute","top":(pos.top-point_to.height())+"px",left:(pos.left+point_to.width()+30)+"px"});
		}

	},


	PopOverContent:function(id_){

		return '<div id="'+id_+'" class="popover right block z-depth-5 "><div class="arrow"></div><h3 class="popover-title">Post Preview</h3><div class="'+this.PopOverContentElement+'"></div></div>';
	},

	Destroy:function(){

		var p=$("#"+this.PopOverId);

		if(p.length){

			p.remove();

		}
	}

};

var InvitePeopleToCircle={

Triggerer:".manage-circle-trigger",
CIDAttribute:Globals.CIDAttribute,
ContainerClass:"manage-circle-trigger-wrap",


Init:function(){

var this_=this;

$(document).on("click",this.Triggerer,function(e){

LoadInit($(this));

});

},


LoadInit:function(elem){

var $this=elem,
	this_=this;

if(Helpers.HasAttribute($this,this_.CIDAttribute)){

var cid_=$this.attr(this_.CIDAttribute);

if(cid_.length){

this_.GetCirclePopup(cid_);

}

}

},


GetCirclePopup:function(cid){

var modal_=ModalAlert.SetupModal(this.GetBeforeresponseContent(),"Add and Invite People"),
container_=this.GetContainer(modal_),
this_=this;

if(container_){

Preloaders.PutPreloader(container_);

$.post(Helpers.AjaxURL("InvitePeople"),{cid:cid},function(d){

Preloaders.RemovePreloader(container_);

var data_=GetResponse.Get(d);

if(data_ && data_.status){

this_.AfterResponse(container_,data_.data);

}

});

}

},


AfterResponse:function(container_,data){

container_.html(data);

Helpers.FocusOnFirstInput(container_);

InvitePeopleSearch.Init();

},

GetContainer:function(modal_){

var container_=modal_.find("."+this.ContainerClass);

return container_.length?container_:false;

},

GetBeforeresponseContent:function(){

return "<div class='"+this.ContainerClass+"'></div>";

},


};



var AppNotifications={


 Notify:function (content_,type_, from, align, icon, animIn, animOut){
                $.growl(content_,{
                        element: 'body',
                        type: type_,
                        allow_dismiss: true,
                        placement: {
                                from: from,
                                align: align
                        },
                        offset: {
                            x: 20,
                            y: 85
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 200,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                                enter: animIn,
                                exit: animOut
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" class="alert '+(!type_?" white-border":"")+'" role="alert">' +
                                        '<button type="button" class="close" data-growl="dismiss">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '<span class="sr-only">Close</span>' +
                                        '</button>' +
                                        '<span data-growl="icon"></span>' +
                                        '<span data-growl="title"></span>' +
                                        '<span data-growl="message"></span>' +
                                        '<a href="#" data-growl="url"></a>' +
                                    '</div>'
                });
            },
            

            ContentObject:function(message,title_,url){

            	return {

                    title: "",//title_?title_+" | ":'',
                    message: message,
                    url: url?url:''
                } 

            },
           
           PutNoti:function(message_,title_,type_,url,animIn,animOut){

           	this.Notify(this.ContentObject(message_,title_,url),type_,"top","center",false,animIn,animOut);


           }, 

           PutNotiRight:function(message_,title_,type_,url,animIn,animOut){

           	this.Notify(this.ContentObject(message_,title_,url),type_,"top","right",false,animIn,animOut);

           },



};

$.fn.isOnScreen = function(){
     
    var win = $(window);
     
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
     
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
     
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
     
};

//To save data from google login
onSignIn = function(response)
{
	console.log(response);
 	AppSignUpSocial.Signup(response.wc.hg,response.wc.wc,"","",response.El,'google');
}

//To signout from google login
signOut = function() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
      auth2.disconnect();
    }

//Called after google api js loads
onLoad = function() {
	console.log("Onload called");
      gapi.load('auth2', function() {
        auth2 = gapi.auth2.init({
            client_id : "157156979361-qdfufbfjssf17bs438jc5bppah36vjf3.apps.googleusercontent.com",
            cookiepolicy: 'single_host_origin',
        });
        attachSignin(document.getElementById('customBtn'),auth2);
      });
      
    }

//Google Login button code
googleUser = {};
startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '157156979361-qdfufbfjssf17bs438jc5bppah36vjf3.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

attachSignin = function(element,auth2) {
    
    auth2.attachClickHandler(element, {},
        function(response) {
          	console.log(response);
 			AppSignUpSocial.Signup(response.wc.hg,response.wc.wc,"","",response.El,'google');
        }, function(error) {
          console.log("Fello");
        });
  }

 //Run timer for notifications
 prevTime = 0;
 setInterval(function(){ 
 	
 	$(".timer_div").each(function(){
 		var previous = $(this).attr("time")*1000;
 		var msPerMinute = 60 * 1000;
	    var msPerHour = msPerMinute * 60;
	    var msPerDay = msPerHour * 24;
	    var msPerMonth = msPerDay * 30;
	    var msPerYear = msPerDay * 365;
	    var ago = "";
	    var d = new Date();
		var current = d.getTime();

		var elapsed = current - previous + 134000;

	   if(elapsed<=1000)
	   {
			ago = 'just now';
	   }

	    else if (elapsed < msPerMinute) {
	    	 	 ago =  Math.round(elapsed/1000) + ' second ago';
	    }

	    else if (elapsed < msPerHour) {
	    	 	ago =  Math.round(elapsed/msPerMinute) + ' minute ago';
	    }

	    else if (elapsed < msPerDay ) {
	         	ago =  Math.round(elapsed/msPerHour ) + ' hour ago';  
	    }

	    else if (elapsed < msPerMonth) {
	    	if(Math.round(elapsed/msPerDay)>1)
	    	{
	    		ago = Math.round(elapsed/msPerDay) + ' days ago'; 
	    	}
	    	else
	    	{
	    		ago = Math.round(elapsed/msPerDay) + ' day ago'; 
	    	}
	    }

	    else if (elapsed < msPerYear) {
	    	if(Math.round(elapsed/msPerMonth)>1)
	    	{
	    		ago = Math.round(elapsed/msPerMonth) + ' month ago';   
	    	}
	        else
	        {
	        	ago = Math.round(elapsed/msPerMonth) + ' months ago';   
	        }
	    }

	    else {
	    	if(Math.round(elapsed/msPerYear )>1)
	    	{
	    		ago = Math.round(elapsed/msPerYear ) + ' years ago';
	    	}
	         else{
	         	ago = Math.round(elapsed/msPerYear ) + ' year ago';
	         }  
	    }
	    //console.clear();
	    //console.log(ago);
	    //console.log(current);
	    //console.log(previous);
	    //console.log(elapsed);
	    $(this).html(ago);
 	});
 }, 1000);
