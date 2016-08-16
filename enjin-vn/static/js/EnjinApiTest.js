/**
 * Enjin API SDK For Test
 * Require jQuery library
 * Created by thinhnh on 7/24/15.
 */


var APIListDataTest = {
    login: {
    name: "Login API",
        methods: {
            login: {
                data: {
                unique_id: "thinh",
                    password: 'password'
                },
            }
        }
    },
    prefecture: {
        name: "Prefectures API (R)",
        methods: {
            get: {
                data: {
                    prefecture_id: 1
                }
            }
        }
    },
    city: {
        name: "Cities API (R)",
        methods: {
            get: {
                data: {
                    city_id: 1
                }
            },
            list: {

            }
        }
    },event: {
        name: "Events API (R)",
        methods: {
            get: {
                data: {
                    ev_event_id: 1
                }
            }, list: {},
            listByCandidate: {},
            search: {
                data : {
                    job_vote_id: 1,
                    type: 1,
                    screening_stage_id: 1,
                    screening_stage_type: 1
                }
            }
        }
    },evHistories: {
        name: "EvHistories API",
        methods: {
            post: {
                data: {
                    ev_schedule_id : 1
                },
            },put: {
                data: {
                    ev_history_id:1
                },
            },detail: {
                data: {
                    ev_history_id: 1
                }
            },
            listByCandidate: {}
        }
    }
    ,jobVote: {
        name: "Job votes API (R)",
        methods: {
            get: {
                data: {
                    job_vote_id: 1
                }
            }, list: {},
            search:{}
        }
    },jobType: {
        name: "Job Types API (R)",
        methods: {
            get: {
                data: {
                    jobtype_id: 1
                }
            }, list: {}
        }
    },market: {
        name: "Markets API (R)",
        methods: {
            get: {
                data: {
                    market_id: 1
                }
            }, list: {}
        }
    },country: {
        name: "Countries API (R)",
        methods: {
            get: {
                data: {
                    country_id: 1
                }
            }, list: {}
        }
    },language: {
        name: "Language API (R)",
        methods: {
            get: {
                data: {
                    country_id: 1
                }
            }, list: {}
        }
    },qualification: {
        name: "Qualification API (R)",
        methods: {
            get: {
                data: {
                    qualification_id: 1
                }
            },
            list: {}
        }
    },undergraduates: {
        name: "Undergraduates API (R)",
        methods: {
            get: {
                data: {
                    undergraduate_id: 1
                }
            },
            list: {}
        }
    }, businesses: {
        name: "Businesses API (R)",
        methods: {
            get: {
                data: {
                    business_id: 1
                }
            },
            list: {}
        }
    },classification: {
        name: "Classification API (R)",
        methods: {
            get: {
                data: {
                    class_id: 1,
                    class_type: 0
                }
            },
            list: {
                data: {
                    class_type: 0
                }
            }
        }
    },
    languages: {
        name: "Languages API",
        methods: {
            post: {
                data: {
                    foreign_language_id : 1,
                    foreign_language : '',
                    level_id : 1,
                    oversea_life : 3,
                }
            },put: {
                data: {
                    id : '',
                    foreign_language_id : 1,
                    foreign_language : '',
                    level_id : 1,
                    oversea_life : 3,
                }
            },detail: {
                data :{
                    can_language_id: 1
                }
            },list: {}
        }
    },
    qualifications: {
        name: "Qualifications API",
        methods: {
            post: {
                data: {
                    qualification_id : 1,
                    qualification : '',
                    score : '',
                    acquisition_date : 20150401,
                }
            },put: {
                data: {
                    id : '',
                    qualification_id : 1,
                    qualification : '',
                    score : '',
                    acquisition_date : 20150401,
                }
            },detail: {
                data: {
                    can_qualification_id: 1
                }
            },list: {}
        }
    },cancandidates: {
        name: "Cancandidates API",
        methods: {
            post: {
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
                    unique_id: 35,
                    ev_schedule_id: 1,
                    job_vote_id:1,
                    referer_company_id:1,
                    country_id: 4,
                    prefecture_id: 1,
                    home_country_id: 4,
                    home_prefecture_id: 1
                }
            },put: {
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
                }
            },detail: {}
        }
    },
    education: {
        name: "Education API",
        methods: {
            post: {
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
                }
            },put: {
                data: {
                    id: '1',
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
            },detail: {
                data: {
                    can_education_id: 1
                }
            }
        }
    },histories: {
        name: "Sel Histories API",
        methods: {
            post: {
                data: {
                    job_vote_id: 1
                },
            },detail: {
                data: {
                    sel_history_id: 1
                }
            }
        }
    }
};

