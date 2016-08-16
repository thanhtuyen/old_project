/**
 * Enjin API SDK
 * Require jQuery library
 * Created by thinhnh on 7/24/15.
 * How to use it:
 * If you want to use an api do like bellow
 *
 * ====================================================================
 * Example: For login API
 * var loginApi = EnjinApi.getApi('login');
 * data  = {
 *  unique_id: 'user_unique_id',
 *  password: 'test'
 * };
 * loginApi.setData(data);
 * loginApi.execute(loginCallback);
 * function loginCallback(respond){
 *  console.log(respond);
 * }
 *
 * ====================================================================
 *
 * Root domain
 *
 * You can change the root domain by set the Enjin.rootUrl
 *
 * Ex: EnjinApi.rootUrl = "http://enjin.local";
 *
 */


/**
 * Define the API List with methods
 */
var APIList = {
    login: {
        methods: {
            login: {
                type: 'POST',
                url: '/Login/',
                checkToken: true
            }
        }
    },
    prefecture: {
        methods: {
            get: {
                url: '/Prefectures'
            }
        }
    },
    city: {
        methods: {
            get: {
                url: '/Cities'
            },
            list: {
                url: '/Cities/list'
            }
        }
    },event: {
        methods: {
            get: {
                url: '/Events'
            }, list: {
                url: '/Events/list'
            }, search: {
                url: '/Events/search'
            }
        }
    },evHistories: {
        methods: {
            post: {
                type: 'POST',
                url: '/EvHistories/post',
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/EvHistories/put',
                checkToken: true
            },detail: {
                url: '/EvHistories'
            },
            listByCandidate: {
                url: '/EvHistories/listByCandidate'
            }
        }
    }
    ,jobVote: {
        methods: {
            get: {
                url: '/JobVotes/'
            }, list: {
                url: '/JobVotes/list'
            },search:{
                url: '/JobVotes/search'
            }
        }
    },jobType: {
        methods: {
            get: {
                url: '/JobTypes'
            }, list: {
                url: '/JobTypes/list'
            }
        }
    },market: {
        methods: {
            get: {
                url: '/Markets/'
            }, list: {
                url: '/Markets/list'
            }
        }
    },country: {
        methods: {
            get: {
                url: '/Countries/'
            }, list: {
                url: '/Countries/list'
            }
        }
    },language: {
        methods: {
            get: {
                url: '/Language'
            }, list: {
                url: '/Language/list'
            }
        }
    },qualification: {
        methods: {
            get: {
                url: '/Qualification/'
            },
            list: {
                url: '/Qualification/list'
            }
        }
    },undergraduates: {
        methods: {
            get: {
                url: '/Undergraduates/'
            },
            list: {
                url: '/Undergraduates/list'
            }
        }
    }, businesses: {
        methods: {
            get: {
                url: '/Businesses/'
            },
            list: {
                url: '/Businesses/list'
            }
        }
    },classification: {
        methods: {
            get: {
                url: '/Classification/'
            },
            list: {
                url: '/Classification/list'
            }
        }
    },
    languages: {
        methods: {
            post: {
                type: 'POST',
                url: '/Languages/post',
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Languages/put',
                checkToken: true
            },detail: {
                url: '/Languages/',
                checkToken: true
            },list: {
                url: '/Languages/list',
            }
        }
    },
    qualifications: {
        methods: {
            post: {
                type: 'POST',
                url: '/Qualifications/post',
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Qualifications/put',
                checkToken: true
            },detail: {
                url: '/Qualifications/',
                checkToken: true
            },list: {
                url: '/Qualifications/list',
            }
        }
    },cancandidates: {
        methods: {
            post: {
                type: 'POST',
                url: '/CanCandidates/post',
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/CanCandidates/put',
                checkToken: true
            },detail: {
                url: '/CanCandidates',
                checkToken: true
            }
        }
    },
    education: {
        methods: {
            post: {
                type: 'POST',
                url: '/Education/post',
                checkToken: true
            },put: {
                type: 'PUT',
                url: '/Education/put',
                checkToken: true
            },detail: {
                url: '/Education/',
                checkToken: true
            }
        }
    },histories: {
        name: "Sel Histories API",
        methods: {
            post: {
                type: 'POST',
                url: '/SelHistories/post',
                checkToken: true
            },detail: {
                url: '/SelHistories/',
                checkToken: true
            }
        }
    }
};

/**
 * The API Method object
 * By default type = GET
 * checkToken: false
 * data: {}
 * @param object
 * @constructor
 */
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

/**
 * Before you execute a method, you need to set data to method object
 * @param data
 */
ApiMethodObject.prototype.setData = function (data){
    this.data = data;
}

/**
 * If you need to change default url of method object
 * use this function
 * @param data
 */
ApiMethodObject.prototype.setUrl = function (url){
    this.url = url;
}

/**
 * Execute the api method
 * @param callback
 */
ApiMethodObject.prototype.execute = function (callback){
    EnjinApi.execute(this, callback);
}

var EnjinApi = {
    apiKey: '',
    companyId: 0,
    rootUrl: '',
    tokenUrl: '/Token/post',
    token: '',
    ajax: function(url, data, type, callbackSuccess, callbackError){
        $.ajax({
            url: EnjinApi.rootUrl + url ,
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
    /**
     * Get Token
     * @param callback
     */
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
    /**
     * Execute a method
     * @param apiMethodObject
     * @param callback
     */
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
    /**
     * Get API object
     * To use methods of an object in APIList
     * You need to get the API object by using this function
     * @param apiName
     * @returns API object with ApiMethodObject (s)
     */
    getApi: function (apiName ){
        var api = APIList[apiName];
        for (var key in api.methods ){
            method = api.methods[key];
            api.methods[key] = new ApiMethodObject(method);
        }
        return api;
    }

};
