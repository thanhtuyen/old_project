/**
 * Enjin API SDK
 * Require jQuery library
 * Created by thinhnh on 08/12/15.
 */


var APIList = {
    jobvote: {
        name: "JobVote (R)",
        methods: {
            GET: {
                url: '/job_votes/api_get/1'
            },setYear: {
                type:'POST',
                url: '/job_votes/api_set_wanted_year',
                data: {
                    year: 1987
                }
            },UpdateStatus: {
                type:'POST',
                url: '/job_votes/api_status',
                data: {
                    id: 1,
                    status: 1
                }
            },List: {
                type:'GET',
                url: '/job_votes/api_list'
            }
        }
    },evhistory: {
        name: "Event history (U)",
        methods: {
            POST: {
                type:'POST',
                url: '/ev_histories/api_update',
                data: {
                    id: 5,
                    after_score: '12453',
                    after_comment: 'comment'
                }
            }, status: {
                type:'POST',
                url: '/ev_histories/api_status',
                data: {
                    id: 5,
                    status: 2
                }
            }, Create: {
                type:'POST',
                url: '/ev_histories/api_add',
                data: {
                    can_candidate_id: 1,
                    ev_schedule_id: 1
                }
            }, Delete: {
                url: '/ev_histories/api_delete/1'
            }
        }
    },evpersonnel: {
        name: "Event Personnel (U)",
        methods: {
            POST: {
                type:'POST',
                url: '/ev_personnels/api_add',
                data: {
                    ev_event_id: 2,
                    rec_recruiter_id: 2
                }
            },
            delete: {
                url: '/ev_personnels/api_delete/1'
            },
            GET:{
                url : '/ev_personnels/api_list'
            }
        }
    },candocument: {
        name: "Can Document API",
        methods: {
            POST: {
                type:'POST',
                url: '/can_documents/api_file_add',
                form: {
                    form_id: 'can_document_form',
                    model: {
                        can_candidate_id: {
                            "fbid" : "can_candidate_id",
                            "label" : "can_candidate_id",
                            "type" : "text",
                            "sortOrder": 1
                        },ev_history_id: {
                            "fbid" : "ev_history_id",
                            "label" : "ev_history_id",
                            "type" : "text",
                            "sortOrder": 2
                        },sel_history_id: {
                            "fbid" : "sel_history_id",
                            "label" : "sel_history_id",
                            "type" : "text",
                            "sortOrder": 3
                        }, binary_data: {
                            "fbid" : "file",
                            "label" : "File",
                            "type" : "file",
                            "sortOrder": 5
                        }
                    }
                }
            },
            GET:{
                url : '/can_documents/api_list?can_candidate_id=1&ev_history_id=2&sel_history_id=2'
            },delete: {
                url: '/can_documents/api_delete/2,3,4'
            }
        }
    },rec_department: {
        name: "Rec Department API",
        methods: {
            POST:{
                type: "POST",
                url: "/rec_departments/api_add",
                data: {
                    department_name: "new department",
                    parent_id: 1,
                    hr_flag: 0
                }
            },delete: {
                url: '/rec_departments/api_delete/1'
            }
        }
    },sel_recruiter_history:{
        name: "Sel Recruiter History (U)",
        methods:{
            INSERT: {
                type: 'POST',
                url: '/sel_recruiter_histories/api_add',
                data: {
                    sel_history_id: 1,
                    rec_recruiter_id: 1
                }
            },UPDATE: {
                type: 'POST',
                url: '/sel_recruiter_histories/api_update',
                data: {
                    id: 1,
                    assign_situation_id: 0,
                    evaluation_rank: 1,
                    evaluation_score: 12,
                    evaluation_comment: "abc"
                }
            },
            GET:{
                url : '/sel_recruiter_histories/api_get/1'
            },delete: {
                url: '/sel_recruiter_histories/api_delete/1'
            }
        }
    },rec_recruiter:{
        name:"Rec Recruiter",
        methods:{
            delete:{
                url: '/rec_recruiters/api_delete/1'
            }
        }
    }, screening_stages:{
        name : "Screening Stages",
        methods:{
            GET:{
                url : '/screening_stages/api_list'
            }
        }

    },evEvent:{
        name:"Ev Event",
        methods:{
            List:{
                url: '/ev_events/api_list'
            }
        }
    },RefererCompany:{
        name:"Referrer Company",
        methods:{
            List:{
                url: '/referer_companies/api_list'
            }
        }
    },selHistory: {
    name:"Sel History",
        methods:{
        POST:{
            type: "POST",
                url: "/sel_histories/api_add",
                data: {
                job_vote_id: 1,
                    can_candidate_id: 1
                }
            }
        }
    }
};

var ApiMethodObject = function(object){
    var attributes = $.extend({
        type: 'GET',
        url: '',
        checkToken: false,
        data: {},
        form: {}
    }, object);
    this.url = attributes.url;
    this.type = attributes.type;
    this.checkToken = attributes.checkToken;
    this.data = attributes.data ;
    this.form = attributes.form;

}

ApiMethodObject.prototype.setData = function (data){
    this.data = data;
}

ApiMethodObject.prototype.setUrl = function (url){
    this.url = url;
}

ApiMethodObject.prototype.execute = function (callback){
    EnjinApi.execute(this, callback);
}

var EnjinApi = {
    rootUrl:'http://enjinshinsotu.local',
    apiKey: '',
    companyId: 0,
    tokenUrl: '/Token/post',
    token: '',
    ajax: function(url, data, type, callbackSuccess, callbackError){
        $.ajax({
            url: EnjinApi.rootUrl+url ,
            dataType: "json" ,
            type: type,
            data: data
        }).done(function(d){
            callbackSuccess(d);
        }).fail(function( xhr, textStatus, errorThrown ){
            if (callbackError)
                callbackError(xhr);
        });
    },
    getToken: function(callback){
        var param = {
            api_key: EnjinApi.apiKey,
            rec_company_id: EnjinApi.companyId
        }
        EnjinApi.ajax(EnjinApi.tokenUrl, param, 'POST', function(res){
            EnjinApi.token = res.token;
            callback();
        });
    },
    execute: function(apiMethodObject, callback){

        if (!apiMethodObject.checkToken || (apiMethodObject.checkToken && EnjinApi.token!="")){
            /*var param = {
                api_key: EnjinApi.apiKey,
                rec_company_id: EnjinApi.companyId,
                token: EnjinApi.token
            }*/
            param = $.extend({}, apiMethodObject.data);
            console.log(param);
            EnjinApi.ajax(apiMethodObject.url, param, apiMethodObject.type,callback,callback)
            //clear token
            EnjinApi.token = "";
            return ;
        }
        if (apiMethodObject.checkToken){
            EnjinApi.getToken(function(){
                EnjinApi.execute(apiMethodObject, callback, callback)
            });
        }
    },
    getApi: function (apiName ){
        var api = APIList[apiName];
        for (var key in api.methods ){
            method = api.methods[key];
            api.methods[key] = new ApiMethodObject(method);
        }
        return api;
    }

};
