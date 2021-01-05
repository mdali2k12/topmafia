(function e(t, n, r) {
    function s(o, u) {
        if (!n[o]) {
            if (!t[o]) {
                var a = typeof require == "function" && require;
                if (!u && a) return a(o, !0);
                if (i) return i(o, !0);
                var f = new Error("Cannot find module '" + o + "'");
                throw f.code = "MODULE_NOT_FOUND", f
            }
            var l = n[o] = {
                exports: {}
            };
            t[o][0].call(l.exports, function(e) {
                var n = t[o][1][e];
                return s(n ? n : e)
            }, l, l.exports, e, t, n, r)
        }
        return n[o].exports
    }
    var i = typeof require == "function" && require;
    for (var o = 0; o < r.length; o++) s(r[o]);
    return s
})({
    1: [function(require, module, exports) {
        "use strict";
        require("./interface/loading"), require("./interface/back"), require("./interface/sorting"), require("./pages/banned"), require("./pages/hideout"), require("./pages/index"), require("./pages/round");

    }, {
        "./interface/back": 2,
        "./interface/loading": 3,
        "./interface/sorting": 4,
        "./pages/banned": 5,
        "./pages/hideout": 6,
        "./pages/index": 7,
        "./pages/round": 8
    }],
    2: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        var _servicesPage = require("../services/Page"),
            _servicesPage2 = _interopRequireDefault(_servicesPage);
        window.addEventListener("gn.android.back", function() {
            "password" == _servicesPage2["default"].getPageId() ? history.back() : GnAndroidApi.exit()
        });

    }, {
        "../services/Page": 10
    }],
    3: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        var _servicesLoadingScreen = require("../services/LoadingScreen"),
            _servicesLoadingScreen2 = _interopRequireDefault(_servicesLoadingScreen);
        window.addEventListener("DOMContentLoaded", function() {
            var e = document.querySelectorAll("a[gn-loading-screen], form[gn-loading-screen]");
            [].forEach.call(e, function(e) {
                document.documentElement.classList.contains("platform-android") || e.addEventListener("A" == e.tagName ? "click" : "submit", function() {
                    var n = e.getAttribute("gn-loading-screen");
                    _servicesLoadingScreen2["default"].show(n || null)
                })
            })
        });

    }, {
        "../services/LoadingScreen": 9
    }],
    4: [function(require, module, exports) {
        "use strict";
        document.addEventListener("DOMContentLoaded", function() {
            var e = document.querySelector("#content");
            [].slice.call(e.querySelectorAll("table.sortable")).forEach(function(e) {
                var t = e.querySelectorAll("thead th"),
                    a = e.querySelector("tbody");
                [].slice.call(t).forEach(function(e, r) {
                    e.addEventListener("click", function() {
                        var l = "asc" == this.getAttribute("data-gn-sorted") ? "desc" : "asc";
                        [].slice.call(t).forEach(function(e) {
                            e.removeAttribute("data-gn-sorted")
                        }), e.setAttribute("data-gn-sorted", l);
                        var c = this.getAttribute("data-gn-sort"),
                            n = [];
                        [].slice.call(a.querySelectorAll("tr")).forEach(function(e) {
                            var t = e.querySelector("td:nth-child(" + (r + 1) + ")").textContent;
                            "number" == c ? t = parseFloat(t.replace(/,/g, "")) : "$" == t[0] ? t = parseFloat(t.substr(1).replace(/,/gi, "")) : !isNaN(parseFloat(t)) && isFinite(t) && (t = parseFloat(t)), NaN === t && (t = 0), n.push({
                                el: e,
                                value: t
                            })
                        }), n.sort(function(e, t) {
                            return e.value < t.value ? "asc" == l ? -1 : 1 : e.value > t.value ? "asc" == l ? 1 : -1 : 0
                        }), n.forEach(function(e) {
                            a.appendChild(e.el)
                        })
                    })
                })
            })
        });

    }, {}],
    5: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        var _servicesReady = require("../services/Ready"),
            _servicesReady2 = _interopRequireDefault(_servicesReady),
            _servicesLoadingScreen = require("../services/LoadingScreen"),
            _servicesLoadingScreen2 = _interopRequireDefault(_servicesLoadingScreen);
        _servicesReady2["default"].on("banned", function(e) {
            function n() {
                _servicesLoadingScreen2["default"].show(), window.location.reload()
            }
            var r = JSON.parse(e.querySelector("div.content").getAttribute("gn-ban-details"));
            setInterval(function() {
                fetch("/api/me/ban", {
                    credentials: "same-origin",
                    cache: "no-store",
                    headers: {
                        "X-GN-API": "true"
                    }
                }).then(function(e) {
                    e.ok ? e.json().then(function(e) {
                        (e.id != r.id || e.created_at != r.created_at || e.expires_at != r.expires_at || e.reason != r.reason) && n()
                    }, function(e) {
                        n()
                    }) : n()
                })
            }, 2e4)
        });

    }, {
        "../services/LoadingScreen": 9,
        "../services/Ready": 11
    }],
    6: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        var _servicesReady = require("../services/Ready"),
            _servicesReady2 = _interopRequireDefault(_servicesReady),
            _servicesLoadingScreen = require("../services/LoadingScreen"),
            _servicesLoadingScreen2 = _interopRequireDefault(_servicesLoadingScreen);
        _servicesReady2["default"].on("hideout", function(e) {
            function t() {
                _servicesLoadingScreen2["default"].show(), window.location.reload()
            }

            function n(e) {
                return e = "" + e, 1 == e.length ? "0" + e : e
            }

            function i(e, t, i) {
                var o = e + ":" + n(t) + ":" + n(i);
                r.textContent = o, document.title = "(" + o + document.title.substr(document.title.indexOf(")"))
            }
            var r = e.querySelector("p.countdown"),
                o = parseInt(r.getAttribute("gn-seconds-remaining"), 10);
            setInterval(function() {
                fetch("/api/me", {
                    credentials: "same-origin",
                    cache: "no-store",
                    headers: {
                        "X-GN-API": "true"
                    }
                }).then(function(e) {
                    e.ok ? e.json().then(function(n) {
                        if (n.hideout_until) {
                            var i = new Date(e.headers.get("Date")),
                                r = new Date(n.hideout_until.replace(" ", "T") + "Z");
                            o = (r.getTime() - i.getTime()) / 1e3
                        } else t()
                    }) : t()
                })
            }, 2e4), setInterval(function() {
                if (o--, o >= 0) {
                    var e = Math.floor(o / 3600),
                        n = Math.floor(o / 60) - 60 * e,
                        r = o - 3600 * e - 60 * n;
                    i(e, n, r)
                } else i(0, 0, 0), t()
            }, 1e3)
        });

    }, {
        "../services/LoadingScreen": 9,
        "../services/Ready": 11
    }],
    7: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }

        function makeLoginRequest(e, n) {
            _servicesResponseMessage2["default"].hide(), _servicesLoadingScreen2["default"].show("Logging in, please wait...");
            var s = fetch(e, {
                credentials: "same-origin",
                cache: "no-store",
                method: "POST",
                body: JSON.stringify(n),
                headers: {
                    "Content-Type": "application/json;charset=UTF-8",
                    Accept: "application/json",
                    "X-GN-API": "true"
                }
            }).then(function(e) {
                e.json().then(function(n) {
                    _servicesLoadingScreen2["default"].hide(), e.ok ? (document.cookie = "gn-session-key=" + n.key + ";path=/;max-age=630720000;secure", document.location.href = "/main") : _servicesResponseMessage2["default"].error(n.errors[0].message)
                }, function(e) {
                    _servicesResponseMessage2["default"].error("The response could not be parsed, please try again later or email contact@mafiamobi.com if this error continues."), _servicesLoadingScreen2["default"].hide()
                })
            }, function(e) {
                _servicesResponseMessage2["default"].error("The request failed, please try again later or email contact@mafiamobi.com if this error continues."), _servicesLoadingScreen2["default"].hide()
            });
            return s
        }
        var _servicesReady = require("../services/Ready"),
            _servicesReady2 = _interopRequireDefault(_servicesReady),
            _servicesResponseMessage = require("../services/ResponseMessage"),
            _servicesResponseMessage2 = _interopRequireDefault(_servicesResponseMessage),
            _servicesLoadingScreen = require("../services/LoadingScreen"),
            _servicesLoadingScreen2 = _interopRequireDefault(_servicesLoadingScreen);
        _servicesReady2["default"].on("index", function(e) {
            var n = e.querySelector("div.external.android a.google");
            n && n.addEventListener("click", function(e) {
                e.preventDefault(), GnAndroidApi.loginWithGoogle().then(function(e) {
                    makeLoginRequest("/api/auth/google", {
                        id_token: e.idToken,
                        platform: "android"
                    })
                }, function(e) {
                    _servicesResponseMessage2["default"].error("Login with Google failed, please try again later.")
                })
            })
        }), _servicesReady2["default"].on("index", function(e) {
            var n = e.querySelector("div.external.android a.facebook");
            n && n.addEventListener("click", function(e) {
                e.preventDefault(), GnAndroidApi.loginWithFacebook(["email"]).then(function(e) {
                    makeLoginRequest("/api/auth/facebook", {
                        access_token: e.accessToken.token,
                        platform: "android"
                    })
                }, function(e) {
                    _servicesResponseMessage2["default"].error("Login with Facebook failed, please try again later.")
                })
            })
        }), _servicesReady2["default"].on("index", function(e) {
            var n = e.querySelectorAll("div.tabs div.tabs-buttons button"),
                s = e.querySelectorAll("div.tabs div.tabs-content");
            [].forEach.call(n, function(e) {
                e.addEventListener("click", function() {
                    var e = this;
                    [].forEach.call(n, function(e) {
                        return e.classList.remove("active")
                    }), this.classList.add("active"), [].forEach.call(s, function(n) {
                        n.getAttribute("data-tab") === e.getAttribute("data-tab") ? n.classList.add("active") : n.classList.remove("active")
                    })
                })
            })
        });

    }, {
        "../services/LoadingScreen": 9,
        "../services/Ready": 11,
        "../services/ResponseMessage": 12
    }],
    8: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        var _servicesReady = require("../services/Ready"),
            _servicesReady2 = _interopRequireDefault(_servicesReady),
            _servicesLoadingScreen = require("../services/LoadingScreen"),
            _servicesLoadingScreen2 = _interopRequireDefault(_servicesLoadingScreen);
        _servicesReady2["default"].on("round", function(e) {
            function t() {
                _servicesLoadingScreen2["default"].show(), window.location.reload()
            }

            function n(e) {
                return e = "" + e, 1 == e.length ? "0" + e : e
            }

            function r(e, t, r) {
                var o = e + ":" + n(t) + ":" + n(r);
                i.textContent = o, document.title = "(" + o + document.title.substr(document.title.indexOf(")"))
            }
            var i = e.querySelector("p.countdown"),
                o = parseInt(i.getAttribute("gn-seconds-remaining"), 10);
            setInterval(function() {
                fetch("/api/rounds/current", {
                    credentials: "same-origin",
                    cache: "no-store",
                    headers: {
                        "X-GN-Api": "true"
                    }
                }).then(function(e) {
                    e.ok && e.json().then(function(n) {
                        if (n.is_active) t();
                        else {
                            var r = new Date(e.headers.get("Date")),
                                i = new Date(n.starts_at.replace(" ", "T") + "Z");
                            o = (i.getTime() - r.getTime()) / 1e3
                        }
                    })
                })
            }, 2e4), setInterval(function() {
                if (o--, o >= 0) {
                    var e = Math.floor(o / 3600),
                        n = Math.floor(o / 60) - 60 * e,
                        i = o - 3600 * e - 60 * n;
                    r(e, n, i)
                } else r(0, 0, 0), t()
            }, 1e3)
        });

    }, {
        "../services/LoadingScreen": 9,
        "../services/Ready": 11
    }],
    9: [function(require, module, exports) {
        "use strict";
        Object.defineProperty(exports, "__esModule", {
            value: !0
        });
        var self = {};
        self.show = function(e) {
            var t = this;
            e || (e = "Loading, please wait..."), this.element || (this.element = document.createElement("div"), this.element.id = "loading-modal", this.element.innerHTML = '<div class="loading-modal"><div class="inner"><div class="spinner"></div><p></p></div></div>', document.body.appendChild(this.element)), this.element.querySelector("p").textContent = e, this.element.classList.add("active"), setTimeout(function() {
                t.element.classList.add("visible")
            }, 0), [].slice.call(document.body.querySelectorAll("input")).forEach(function(e) {
                e.blur()
            })
        }, self.hide = function() {
            this.element.classList.remove("active"), this.element.classList.remove("visible")
        }, exports["default"] = self, module.exports = exports["default"];

    }, {}],
    10: [function(require, module, exports) {
        "use strict";
        Object.defineProperty(exports, "__esModule", {
            value: !0
        });
        var self = {},
            pageEl;
        self.getPageId = function() {
            return self.getPageEl().id.substr(5)
        }, self.getPageEl = function() {
            return pageEl || (pageEl = document.querySelector("#content div.page")), pageEl
        }, self.failed = function() {
            self.getPageEl().id = "page-error", self.getPageEl().innerHTML = '<div class="content"><h1>Page Error</h1><hr class="general"><p>There was an error loading this page, please <a href="' + window.location.href + '">try reloading</a>.</p></div>'
        }, exports["default"] = self, module.exports = exports["default"];

    }, {}],
    11: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(e) {
            return e && e.__esModule ? e : {
                "default": e
            }
        }
        Object.defineProperty(exports, "__esModule", {
            value: !0
        });
        var _Page = require("./Page"),
            _Page2 = _interopRequireDefault(_Page),
            self = {},
            ready, queue = [];
        self.on = function(e, t) {
            "string" == typeof e && (e = [e]), ready ? e.forEach(function(e) {
                _Page2["default"].getPageId() == e && t.call(null, _Page2["default"].getPageEl(), _Page2["default"].getPageId())
            }) : queue.push(arguments)
        }, window.addEventListener("DOMContentLoaded", function() {
            ready || (ready = !0, queue.forEach(function(e) {
                self.on.apply(null, e)
            }))
        }), exports["default"] = self, module.exports = exports["default"];

    }, {
        "./Page": 10
    }],
    12: [function(require, module, exports) {
        "use strict";
        Object.defineProperty(exports, "__esModule", {
            value: !0
        });
        var self = {};
        self.getElement = function() {
            var e = document.querySelector("#content div.container-inner"),
                s = e.querySelector("ul.response-message");
            return s || (s = document.createElement("ul"), s.classList.add("response-message"), e.insertBefore(s, e.querySelector("div.page"))), s
        }, self.show = function(e, s) {
            var r = this.getElement();
            r.className = "response-message " + e, r.innerHTML = "<li>" + s + "</li>", window.scrollTo(0, 0)
        }, self.hide = function() {
            var e = this.getElement();
            e.parentNode.removeChild(e)
        }, self.error = function(e) {
            self.show("error", e)
        }, self.success = function(e) {
            self.show("success", e)
        }, exports["default"] = self, module.exports = exports["default"];

    }, {}]
}, {}, [1]);