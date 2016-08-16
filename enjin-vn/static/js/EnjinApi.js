/**
 * Enjin API SDK
 * Require jQuery library
 * Created by thinhnh on 7/24/15.
 */


var APIList = {
    login: {
    name: "Login API",
        methods: {
            login: {
                type: 'POST',
                    url: 'Login/',
                    data: {
                    unique_id: "thinh",
                        password: 'password'
                },
                checkToken: true
            }
        }
    },
    prefecture: {
        name: "Prefectures API (R)",
        methods: {
            GET: {
                url: '/Prefectures/?prefecture_id=1'
            }
        }
    },
    city: {
        name: "Cities API (R)",
        methods: {
            GET: {
                url: '/Cities/?city_id=1'
            },
            list: {
                url: '/Cities/list'
            }
        }
    },event: {
        name: "Events API (R)",
        methods: {
            GET: {
                url: '/Events/?ev_event_id=1'
            }, list: {
                url: '/Events/list'
            },listByCandidate: {
                url: '/Events/listByCandidate'
            }, search: {
                url: '/Events/search?job_vote_id=1&type=1&screening_stage_id=1&screening_stage_type=1'
            }
        }
    },EvHistories: {
        name: "EvHistories API",
        methods: {
            post: {
                type: 'POST',
                url: '/EvHistories/post',
                data: {
                    ev_schedule_id : 1
                },
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/EvHistories/put',
                data: {
                    ev_history_id:1
                },
                checkToken: true
            },detail: {
                url: '/EvHistories/?ev_history_id=1',
                checkToken: true
            },
            list_by_candidate: {
                url: '/EvHistories/listByCandidate'
            }
        }
    }
    ,jobVote: {
        name: "Job votes API (R)",
        methods: {
            GET: {
                url: '/JobVotes/?job_vote_id=1'
            }, list: {
                url: '/JobVotes/list'
            },search:{
                url: 'JobVotes/search'
            }
        }
    },jobType: {
        name: "Job Types API (R)",
        methods: {
            GET: {
                url: '/JobTypes/?jobtype_id=1'
            }, list: {
                url: '/JobTypes/list'
            }
        }
    },market: {
        name: "Markets API (R)",
        methods: {
            GET: {
                url: '/Markets/?market_id=1'
            }, list: {
                url: '/Markets/list'
            }
        }
    },country: {
        name: "Countries API (R)",
        methods: {
            GET: {
                url: '/Countries/?country_id=1'
            }, list: {
                url: '/Countries/list'
            }
        }
    },language: {
        name: "Language API (R)",
        methods: {
            GET: {
                url: '/Language/?country_id=1'
            }, list: {
                url: '/Language/list'
            }
        }
    },qualification: {
        name: "Qualification API (R)",
        methods: {
            GET: {
                url: '/Qualification/?qualification_id=1'
            },
            LIST: {
                url: '/Qualification/list'
            }
        }
    },undergraduates: {
        name: "Undergraduates API (R)",
        methods: {
            GET: {
                url: '/Undergraduates/?undergraduate_id=1'
            },
            LIST: {
                url: '/Undergraduates/list'
            }
        }
    }, businesses: {
        name: "Businesses API (R)",
        methods: {
            GET: {
                url: '/Businesses/?business_id=1'
            },
            LIST: {
                url: '/Businesses/list'
            }
        }
    },classification: {
        name: "Classification API (R)",
        methods: {
            GET: {
                url: '/Classification/?class_id=1&class_type=0'
            },
            LIST: {
                url: '/Classification/list?class_type=0'
            }
        }
    },
    languages: {
        name: "Languages API",
        methods: {
            post: {
                type: 'POST',
                url: '/Languages/post',
                data: {
                    foreign_language_id : 1,
                    foreign_language : '',
                    level_id : 1,
                    oversea_life : 3,
                },
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Languages/put',
                data: {
                    id : '',
                    foreign_language_id : 1,
                    foreign_language : '',
                    level_id : 1,
                    oversea_life : 3,
                },
                checkToken: true
            },detail: {
                url: '/Languages/?can_language_id=1',
                checkToken: true
            },list: {
                url: '/Languages/list',
            }
        }
    },
    qualifications: {
        name: "Qualifications API",
        methods: {
            post: {
                type: 'POST',
                url: '/Qualifications/post',
                data: {
                    qualification_id : 1,
                    qualification : '',
                    score : '',
                    acquisition_date : 20150401,
                },
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Qualifications/put',
                data: {
                    id : '',
                    qualification_id : 1,
                    qualification : '',
                    score : '',
                    acquisition_date : 20150401,
                },
                checkToken: true
            },detail: {
                url: '/Qualifications/?can_qualification_id=1',
                checkToken: true
            },list: {
                url: '/Qualifications/list',
            }
        }
    },cancandidates: {
        name: "Cancandidates API",
        methods: {
            post: {
                type: 'POST',
                url: '/CanCandidates/post',
                data: {
                    last_name: "last_name",
                    last_name_kana: "last_name_kana",
                    mid_name: "mid_name",
                    mid_name_en: "mid_name_en",
                    first_name: "first_name",
                    first_name_en: "first_name,",
                    mail_address:"test6@gmail.com",
                    password : "123456",
                    home_tel : "1234456789",
                    join_possible_date: '20150717',
                    tel:"22-222-2222",
                    extension_number:"22-222-2222",
                    direct_extension:"22-222-2222",
                    cell_number:"22-222-2222",
                    cell_mail:"mail@gmail.com",
                    post_code:"222",
                    home_post_code:"333",
                    unique_id: 35,
                    ev_schedule_id: 1,
                    job_vote_id:1,
                    referer_company_id:1,
                    country_id: 4,
                    prefecture_id: 1,
                    home_country_id: 4,
                    home_prefecture_id: 1
                },
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/CanCandidates/put',
                data: {
                    id:'',
                    last_name: "last_name",
                    last_name_kana: "last_name_kana",
                    mid_name: "mid_name",
                    mid_name_en: "mid_name_en",
                    first_name: "first_name",
                    first_name_en: "first_name,",
                    mail_address:"test6@gmail.com",
                    password : "123456",
                    home_tel : "1234456789",
                    join_possible_date: '20150717',
                    unique_id: 58,
                    ev_schedule_id: 1,
                    job_vote_id:1,
                    referer_company_id:1,
                    country_id: 4,
                    prefecture_id: 1,
                    home_country_id: 4,
                    home_prefecture_id: 1
                },
                checkToken: true
            },detail: {
                url: '/CanCandidates',
                checkToken: true
            }
        }
    },
    education: {
        name: "Education API",
        methods: {
            post: {
                type: 'POST',
                url: '/Education/post',
                data: {
                    school_id: 1,
                    school: '',
                    undergraduate_id: 1,
                    undergraduate: '',
                    department: '',
                    student_bunri_class_id: 1,
                    seminar: '',
                    major_theme: '',
                    circle: '',
                    admission_date: 20120401,
                    graduation_date: 20160331
                },
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Education/put',
                data: {
                    id: '',
                    school_id: 1,
                    school: '',
                    undergraduate_id: 1,
                    undergraduate: '',
                    department: '',
                    student_bunri_class_id: 1,
                    seminar: '',
                    major_theme: '',
                    circle: '',
                    admission_date: 20120401,
                    graduation_date: 20160331
                },
                checkToken: true
            },detail: {
                url: '/Education/?can_education_id=1',
                checkToken: true
            }
        }
    },histories: {
        name: "Sel Histories API",
        methods: {
            post: {
                type: 'POST',
                url: '/SelHistories/post',
                data: {
                    job_vote_id: 1

                },
                checkToken: true
            },detail: {
                url: '/SelHistories/?sel_history_id=1',
                checkToken: true
            }
        }
    }
};

var ApiMethodObject = function(object){
    var attributes = $.extend({
        type: 'GET',
        url: '',
        checkToken: false,
        data: {}
    }, object);
    this.url = attributes.url;
    this.type = attributes.type;
    this.checkToken = attributes.checkToken;
    this.data = attributes.data ;

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
    apiKey: '',
    companyId: 0,
    tokenUrl: '/Token/post',
    token: '',
    ajax: function(url, data, type, callbackSuccess, callbackError){
        $.ajax({
            url: url ,
            async: false ,
            dataType: "json" ,
            type: type,
            data: data ,
            crossDomain: true,
            cache: false

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
            var param = {
                api_key: EnjinApi.apiKey,
                rec_company_id: EnjinApi.companyId,
                token: EnjinApi.token
            }
            param = $.extend(param, apiMethodObject.data);
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
