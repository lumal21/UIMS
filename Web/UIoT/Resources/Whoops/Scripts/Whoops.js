var r = null;
window.PR_SHOULD_USE_CONTINUATION = !0;
(function () {
    function O(a) {
        function i(d) {
            var a = d.charCodeAt(0);
            if (a !== 92)return a;
            var f = d.charAt(1);
            return (a = s[f]) ? a : "0" <= f && f <= "7" ? parseInt(d.substring(1), 8) : f === "u" || f === "x" ? parseInt(d.substring(2), 16) : d.charCodeAt(1)
        }

        function g(d) {
            if (d < 32)return (d < 16 ? "\\x0" : "\\x") + d.toString(16);
            d = String.fromCharCode(d);
            return d === "\\" || d === "-" || d === "]" || d === "^" ? "\\" + d : d
        }

        function j(d) {
            var a = d.substring(1, d.length - 1).match(/\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\[0-3][0-7]{0,2}|\\[0-7]{1,2}|\\[\S\s]|[^\\]/g), d = [], f =
                a[0] === "^", b = ["["];
            f && b.push("^");
            for (var f = f ? 1 : 0, c = a.length; f < c; ++f) {
                var h = a[f];
                if (/\\[bdsw]/i.test(h))b.push(h); else {
                    var h = i(h), e;
                    f + 2 < c && "-" === a[f + 1] ? (e = i(a[f + 2]), f += 2) : e = h;
                    d.push([h, e]);
                    e < 65 || h > 122 || (e < 65 || h > 90 || d.push([Math.max(65, h) | 32, Math.min(e, 90) | 32]), e < 97 || h > 122 || d.push([Math.max(97, h) & -33, Math.min(e, 122) & -33]))
                }
            }
            d.sort(function (d, a) {
                return d[0] - a[0] || a[1] - d[1]
            });
            a = [];
            c = [];
            for (f = 0; f < d.length; ++f)h = d[f], h[0] <= c[1] + 1 ? c[1] = Math.max(c[1], h[1]) : a.push(c = h);
            for (f = 0; f < a.length; ++f)h = a[f], b.push(g(h[0])),
            h[1] > h[0] && (h[1] + 1 > h[0] && b.push("-"), b.push(g(h[1])));
            b.push("]");
            return b.join("")
        }

        function t(d) {
            for (var a = d.source.match(/\[(?:[^\\\]]|\\[\S\s])*]|\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\\d+|\\[^\dux]|\(\?[!:=]|[()^]|[^()[\\^]+/g), b = a.length, i = [], c = 0, h = 0; c < b; ++c) {
                var e = a[c];
                e === "(" ? ++h : "\\" === e.charAt(0) && (e = +e.substring(1)) && (e <= h ? i[e] = -1 : a[c] = g(e))
            }
            for (c = 1; c < i.length; ++c)-1 === i[c] && (i[c] = ++z);
            for (h = c = 0; c < b; ++c)e = a[c], e === "(" ? (++h, i[h] || (a[c] = "(?:")) : "\\" === e.charAt(0) && (e = +e.substring(1)) && e <= h &&
            (a[c] = "\\" + i[e]);
            for (c = 0; c < b; ++c)"^" === a[c] && "^" !== a[c + 1] && (a[c] = "");
            if (d.ignoreCase && w)for (c = 0; c < b; ++c)e = a[c], d = e.charAt(0), e.length >= 2 && d === "[" ? a[c] = j(e) : d !== "\\" && (a[c] = e.replace(/[A-Za-z]/g, function (d) {
                d = d.charCodeAt(0);
                return "[" + String.fromCharCode(d & -33, d | 32) + "]"
            }));
            return a.join("")
        }

        for (var z = 0, w = !1, k = !1, m = 0, b = a.length; m < b; ++m) {
            var o = a[m];
            if (o.ignoreCase)k = !0; else if (/[a-z]/i.test(o.source.replace(/\\u[\da-f]{4}|\\x[\da-f]{2}|\\[^UXux]/gi, ""))) {
                w = !0;
                k = !1;
                break
            }
        }
        for (var s = {
            b: 8, t: 9, n: 10, v: 11,
            f: 12, r: 13
        }, q = [], m = 0, b = a.length; m < b; ++m) {
            o = a[m];
            if (o.global || o.multiline)throw Error("" + o);
            q.push("(?:" + t(o) + ")")
        }
        return RegExp(q.join("|"), k ? "gi" : "g")
    }

    function P(a, i) {
        function g(a) {
            switch (a.nodeType) {
                case 1:
                    if (j.test(a.className))break;
                    for (var b = a.firstChild; b; b = b.nextSibling)g(b);
                    b = a.nodeName.toLowerCase();
                    if ("br" === b || "li" === b)t[k] = "\n", w[k << 1] = z++, w[k++ << 1 | 1] = a;
                    break;
                case 3:
                case 4:
                    b = a.nodeValue, b.length && (b = i ? b.replace(/\r\n?/g, "\n") : b.replace(/[\t\n\r ]+/g, " "), t[k] = b, w[k << 1] = z, z += b.length, w[k++ <<
                    1 | 1] = a)
            }
        }

        var j = /(?:^|\s)nocode(?:\s|$)/, t = [], z = 0, w = [], k = 0;
        g(a);
        return {a: t.join("").replace(/\n$/, ""), d: w}
    }

    function E(a, i, g, j) {
        i && (a = {a: i, e: a}, g(a), j.push.apply(j, a.g))
    }

    function x(a, i) {
        function g(a) {
            for (var k = a.e, m = [k, "pln"], b = 0, o = a.a.match(t) || [], s = {}, q = 0, d = o.length; q < d; ++q) {
                var v = o[q], f = s[v], u = void 0, c;
                if (typeof f === "string")c = !1; else {
                    var h = j[v.charAt(0)];
                    if (h)u = v.match(h[1]), f = h[0]; else {
                        for (c = 0; c < z; ++c)if (h = i[c], u = v.match(h[1])) {
                            f = h[0];
                            break
                        }
                        u || (f = "pln")
                    }
                    if ((c = f.length >= 5 && "lang-" === f.substring(0,
                                5)) && !(u && typeof u[1] === "string"))c = !1, f = "src";
                    c || (s[v] = f)
                }
                h = b;
                b += v.length;
                if (c) {
                    c = u[1];
                    var e = v.indexOf(c), p = e + c.length;
                    u[2] && (p = v.length - u[2].length, e = p - c.length);
                    f = f.substring(5);
                    E(k + h, v.substring(0, e), g, m);
                    E(k + h + e, c, F(f, c), m);
                    E(k + h + p, v.substring(p), g, m)
                } else m.push(k + h, f)
            }
            a.g = m
        }

        var j = {}, t;
        (function () {
            for (var g = a.concat(i), k = [], m = {}, b = 0, o = g.length; b < o; ++b) {
                var s = g[b], q = s[3];
                if (q)for (var d = q.length; --d >= 0;)j[q.charAt(d)] = s;
                s = s[1];
                q = "" + s;
                m.hasOwnProperty(q) || (k.push(s), m[q] = r)
            }
            k.push(/[\S\s]/);
            t =
                O(k)
        })();
        var z = i.length;
        return g
    }

    function l(a) {
        var i = [], g = [];
        a.tripleQuotedStrings ? i.push(["str", /^(?:'''(?:[^'\\]|\\[\S\s]|''?(?=[^']))*(?:'''|$)|"""(?:[^"\\]|\\[\S\s]|""?(?=[^"]))*(?:"""|$)|'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$))/, r, "'\""]) : a.multiLineStrings ? i.push(["str", /^(?:'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$)|`(?:[^\\`]|\\[\S\s])*(?:`|$))/, r, "'\"`"]) : i.push(["str", /^(?:'(?:[^\n\r'\\]|\\.)*(?:'|$)|"(?:[^\n\r"\\]|\\.)*(?:"|$))/, r, "\"'"]);
        a.verbatimStrings &&
        g.push(["str", /^@"(?:[^"]|"")*(?:"|$)/, r]);
        var j = a.hashComments;
        j && (a.cStyleComments ? (j > 1 ? i.push(["com", /^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/, r, "#"]) : i.push(["com", /^#(?:(?:define|e(?:l|nd)if|else|error|ifn?def|include|line|pragma|undef|warning)\b|[^\n\r]*)/, r, "#"]), g.push(["str", /^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h(?:h|pp|\+\+)?|[a-z]\w*)>/, r])) : i.push(["com", /^#[^\n\r]*/, r, "#"]));
        a.cStyleComments && (g.push(["com", /^\/\/[^\n\r]*/, r]), g.push(["com", /^\/\*[\S\s]*?(?:\*\/|$)/,
            r]));
        a.regexLiterals && g.push(["lang-regex", /^(?:^^\.?|[+-]|[!=]={0,2}|#|%=?|&&?=?|\(|\*=?|[+-]=|->|\/=?|::?|<<?=?|>{1,3}=?|[,;?@[{~]|\^\^?=?|\|\|?=?|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\s*(\/(?=[^*/])(?:[^/[\\]|\\[\S\s]|\[(?:[^\\\]]|\\[\S\s])*(?:]|$))+\/)/]);
        (j = a.types) && g.push(["typ", j]);
        a = ("" + a.keywords).replace(/^ | $/g, "");
        a.length && g.push(["kwd", RegExp("^(?:" + a.replace(/[\s,]+/g, "|") + ")\\b"), r]);
        i.push(["pln", /^\s+/, r, " \r\n\t\u00a0"]);
        g.push(["lit",
            /^@[$_a-z][\w$@]*/i, r], ["typ", /^(?:[@_]?[A-Z]+[a-z][\w$@]*|\w+_t\b)/, r], ["pln", /^[$_a-z][\w$@]*/i, r], ["lit", /^(?:0x[\da-f]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+-]?\d+)?)[a-z]*/i, r, "0123456789"], ["pln", /^\\[\S\s]?/, r], ["pun", /^.[^\s\w"$'./@\\`]*/, r]);
        return x(i, g)
    }

    function G(a, i, g) {
        function j(a) {
            switch (a.nodeType) {
                case 1:
                    if (z.test(a.className))break;
                    if ("br" === a.nodeName)t(a), a.parentNode && a.parentNode.removeChild(a); else for (a = a.firstChild; a; a = a.nextSibling)j(a);
                    break;
                case 3:
                case 4:
                    if (g) {
                        var b =
                            a.nodeValue, f = b.match(n);
                        if (f) {
                            var i = b.substring(0, f.index);
                            a.nodeValue = i;
                            (b = b.substring(f.index + f[0].length)) && a.parentNode.insertBefore(k.createTextNode(b), a.nextSibling);
                            t(a);
                            i || a.parentNode.removeChild(a)
                        }
                    }
            }
        }

        function t(a) {
            function i(a, b) {
                var d = b ? a.cloneNode(!1) : a, e = a.parentNode;
                if (e) {
                    var e = i(e, 1), f = a.nextSibling;
                    e.appendChild(d);
                    for (var g = f; g; g = f)f = g.nextSibling, e.appendChild(g)
                }
                return d
            }

            for (; !a.nextSibling;)if (a = a.parentNode, !a)return;
            for (var a = i(a.nextSibling, 0), f; (f = a.parentNode) && f.nodeType ===
            1;)a = f;
            b.push(a)
        }

        for (var z = /(?:^|\s)nocode(?:\s|$)/, n = /\r\n?|\n/, k = a.ownerDocument, m = k.createElement("li"); a.firstChild;)m.appendChild(a.firstChild);
        for (var b = [m], o = 0; o < b.length; ++o)j(b[o]);
        i === (i | 0) && b[0].setAttribute("value", i);
        var s = k.createElement("ol");
        s.className = "linenums";
        for (var i = Math.max(0, i - 1 | 0) || 0, o = 0, q = b.length; o < q; ++o)m = b[o], m.className = "L" + (o + i) % 10, m.firstChild || m.appendChild(k.createTextNode("\u00a0")), s.appendChild(m);
        a.appendChild(s)
    }

    function n(a, i) {
        for (var g = i.length; --g >= 0;) {
            var j =
                i[g];
            A.hasOwnProperty(j) ? C.console && console.warn("cannot override language handler %s", j) : A[j] = a
        }
    }

    function F(a, i) {
        if (!a || !A.hasOwnProperty(a))a = /^\s*</.test(i) ? "default-markup" : "default-code";
        return A[a]
    }

    function H(a) {
        var i = a.h;
        try {
            var g = P(a.c, a.i), j = g.a;
            a.a = j;
            a.d = g.d;
            a.e = 0;
            F(i, j)(a);
            var t = /\bMSIE\s(\d+)/.exec(navigator.userAgent), t = t && +t[1] <= 8, i = /\n/g, n = a.a, w = n.length, g = 0, k = a.d, m = k.length, j = 0, b = a.g, o = b.length, s = 0;
            b[o] = w;
            var q, d;
            for (d = q = 0; d < o;)b[d] !== b[d + 2] ? (b[q++] = b[d++], b[q++] = b[d++]) : d += 2;
            o = q;
            for (d = q = 0; d < o;) {
                for (var v = b[d], f = b[d + 1], u = d + 2; u + 2 <= o && b[u + 1] === f;)u += 2;
                b[q++] = v;
                b[q++] = f;
                d = u
            }
            b.length = q;
            var c = a.c, h;
            if (c)h = c.style.display, c.style.display = "none";
            try {
                for (; j < m;) {
                    var e = k[j + 2] || w, p = b[s + 2] || w, u = Math.min(e, p), l = k[j + 1], D;
                    if (l.nodeType !== 1 && (D = n.substring(g, u))) {
                        t && (D = D.replace(i, "\r"));
                        l.nodeValue = D;
                        var y = l.ownerDocument, x = y.createElement("span");
                        x.className = b[s + 1];
                        var B = l.parentNode;
                        B.replaceChild(x, l);
                        x.appendChild(l);
                        g < e && (k[j + 1] = l = y.createTextNode(n.substring(u, e)), B.insertBefore(l,
                            x.nextSibling))
                    }
                    g = u;
                    g >= e && (j += 2);
                    g >= p && (s += 2)
                }
            } finally {
                if (c)c.style.display = h
            }
        } catch (A) {
            C.console && console.log(A && A.stack ? A.stack : A)
        }
    }

    var C = window, y = ["break,continue,do,else,for,if,return,while"], B = [[y, "auto,case,char,const,default,double,enum,extern,float,goto,int,long,register,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"], "catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"], I = [B, "alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,dynamic_cast,explicit,export,friend,inline,late_check,mutable,namespace,nullptr,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"],
        J = [B, "abstract,boolean,byte,extends,final,finally,implements,import,instanceof,null,native,package,strictfp,super,synchronized,throws,transient"], K = [J, "as,base,by,checked,decimal,delegate,descending,dynamic,event,fixed,foreach,from,group,implicit,in,interface,internal,into,is,let,lock,object,out,override,orderby,params,partial,readonly,ref,sbyte,sealed,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,var,virtual,where"], B = [B, "debugger,eval,export,function,get,null,set,undefined,var,with,Infinity,NaN"],
        L = [y, "and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"], M = [y, "alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"], y = [y, "case,done,elif,esac,eval,fi,function,in,local,set,then,until"], N = /^(DIR|FILE|vector|(de|priority_)?queue|list|stack|(const_)?iterator|(multi)?(set|map)|bitset|u?(int|float)\d*)\b/,
        Q = /\S/, R = l({
            keywords: [I, K, B, "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END" + L, M, y],
            hashComments: !0,
            cStyleComments: !0,
            multiLineStrings: !0,
            regexLiterals: !0
        }), A = {};
    n(R, ["default-code"]);
    n(x([], [["pln", /^[^<?]+/], ["dec", /^<!\w[^>]*(?:>|$)/], ["com", /^<\!--[\S\s]*?(?:--\>|$)/], ["lang-", /^<\?([\S\s]+?)(?:\?>|$)/], ["lang-", /^<%([\S\s]+?)(?:%>|$)/], ["pun", /^(?:<[%?]|[%?]>)/], ["lang-",
        /^<xmp\b[^>]*>([\S\s]+?)<\/xmp\b[^>]*>/i], ["lang-js", /^<script\b[^>]*>([\S\s]*?)(<\/script\b[^>]*>)/i], ["lang-css", /^<style\b[^>]*>([\S\s]*?)(<\/style\b[^>]*>)/i], ["lang-in.tag", /^(<\/?[a-z][^<>]*>)/i]]), ["default-markup", "htm", "html", "mxml", "xhtml", "xml", "xsl"]);
    n(x([["pln", /^\s+/, r, " \t\r\n"], ["atv", /^(?:"[^"]*"?|'[^']*'?)/, r, "\"'"]], [["tag", /^^<\/?[a-z](?:[\w-.:]*\w)?|\/?>$/i], ["atn", /^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i], ["lang-uq.val", /^=\s*([^\s"'>]*(?:[^\s"'/>]|\/(?=\s)))/], ["pun", /^[/<->]+/],
        ["lang-js", /^on\w+\s*=\s*"([^"]+)"/i], ["lang-js", /^on\w+\s*=\s*'([^']+)'/i], ["lang-js", /^on\w+\s*=\s*([^\s"'>]+)/i], ["lang-css", /^style\s*=\s*"([^"]+)"/i], ["lang-css", /^style\s*=\s*'([^']+)'/i], ["lang-css", /^style\s*=\s*([^\s"'>]+)/i]]), ["in.tag"]);
    n(x([], [["atv", /^[\S\s]+/]]), ["uq.val"]);
    n(l({keywords: I, hashComments: !0, cStyleComments: !0, types: N}), ["c", "cc", "cpp", "cxx", "cyc", "m"]);
    n(l({keywords: "null,true,false"}), ["json"]);
    n(l({keywords: K, hashComments: !0, cStyleComments: !0, verbatimStrings: !0, types: N}),
        ["cs"]);
    n(l({keywords: J, cStyleComments: !0}), ["java"]);
    n(l({keywords: y, hashComments: !0, multiLineStrings: !0}), ["bsh", "csh", "sh"]);
    n(l({keywords: L, hashComments: !0, multiLineStrings: !0, tripleQuotedStrings: !0}), ["cv", "py"]);
    n(l({
        keywords: "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END",
        hashComments: !0,
        multiLineStrings: !0,
        regexLiterals: !0
    }), ["perl", "pl", "pm"]);
    n(l({
        keywords: M, hashComments: !0,
        multiLineStrings: !0, regexLiterals: !0
    }), ["rb"]);
    n(l({keywords: B, cStyleComments: !0, regexLiterals: !0}), ["js"]);
    n(l({
        keywords: "all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,throw,true,try,unless,until,when,while,yes",
        hashComments: 3,
        cStyleComments: !0,
        multilineStrings: !0,
        tripleQuotedStrings: !0,
        regexLiterals: !0
    }), ["coffee"]);
    n(x([], [["str", /^[\S\s]+/]]), ["regex"]);
    var S = C.PR = {
        createSimpleLexer: x,
        registerLangHandler: n,
        sourceDecorator: l,
        PR_ATTRIB_NAME: "atn",
        PR_ATTRIB_VALUE: "atv",
        PR_COMMENT: "com",
        PR_DECLARATION: "dec",
        PR_KEYWORD: "kwd",
        PR_LITERAL: "lit",
        PR_NOCODE: "nocode",
        PR_PLAIN: "pln",
        PR_PUNCTUATION: "pun",
        PR_SOURCE: "src",
        PR_STRING: "str",
        PR_TAG: "tag",
        PR_TYPE: "typ",
        prettyPrintOne: C.prettyPrintOne = function (a, i, g) {
            var j = document.createElement("pre");
            j.innerHTML = a;
            g && G(j, g, !0);
            H({h: i, j: g, c: j, i: 1});
            return j.innerHTML
        },
        prettyPrint: C.prettyPrint = function (a) {
            function i() {
                var u;
                for (var g = C.PR_SHOULD_USE_CONTINUATION ? k.now() + 250 : Infinity; m < j.length &&
                k.now() < g; m++) {
                    var c = j[m], h = c.className;
                    if (s.test(h) && !q.test(h)) {
                        for (var e = !1, p = c.parentNode; p; p = p.parentNode)if (f.test(p.tagName) && p.className && s.test(p.className)) {
                            e = !0;
                            break
                        }
                        if (!e) {
                            c.className += " prettyprinted";
                            var h = h.match(o), n;
                            if (e = !h) {
                                for (var e = c, p = void 0, l = e.firstChild; l; l = l.nextSibling)var t = l.nodeType, p = t === 1 ? p ? e : l : t === 3 ? Q.test(l.nodeValue) ? e : p : p;
                                e = (n = p === e ? void 0 : p) && v.test(n.tagName)
                            }
                            e && (h = n.className.match(o));
                            h && (h = h[1]);
                            u = d.test(c.tagName) ? 1 : (e = (e = c.currentStyle) ? e.whiteSpace : document.defaultView &&
                            document.defaultView.getComputedStyle ? document.defaultView.getComputedStyle(c, r).getPropertyValue("white-space") : 0) && "pre" === e.substring(0, 3), e = u;
                            (p = (p = c.className.match(/\blinenums\b(?::(\d+))?/)) ? p[1] && p[1].length ? +p[1] : !0 : !1) && G(c, p, e);
                            b = {h: h, c: c, j: p, i: e};
                            H(b)
                        }
                    }
                }
                m < j.length ? setTimeout(i, 250) : a && a()
            }

            for (var g = [document.getElementsByTagName("pre"), document.getElementsByTagName("code"), document.getElementsByTagName("xmp")], j = [], n = 0; n < g.length; ++n)for (var l = 0, w = g[n].length; l < w; ++l)j.push(g[n][l]);
            var g =
                r, k = Date;
            k.now || (k = {
                now: function () {
                    return +new Date
                }
            });
            var m = 0, b, o = /\blang(?:uage)?-([\w.]+)(?!\S)/, s = /\bprettyprint\b/, q = /\bprettyprinted\b/, d = /pre|xmp/i, v = /^code$/i, f = /^(?:pre|code|xmp)$/i;
            i()
        }
    };
    typeof define === "function" && define.amd && define("google-code-prettify", [], function () {
        return S
    })
})();

Zepto(function ($) {
    // a jQuery.getScript() equivalent to asyncronously load javascript files
    // credits to http://stackoverflow.com/a/8812950/1597388
    var getScript = function (src, func) {
        var script = document.createElement('script');
        script.async = 'async';
        script.src = src;
        if (func) {
            script.onload = func;
        }
        document.getElementsByTagName('head')[0].appendChild(script);
    };

    // load prettify asyncronously to speedup page rendering
    //getScript('Prettify.js', function () {
    prettyPrint();
    //});

    var $frameContainer = $('.frames-container');
    var $container = $('.details-container');
    var $activeLine = $frameContainer.find('.frame.active');
    var $activeFrame = $container.find('.frame-code.active');
    var $ajaxEditors = $('.editor-link[data-ajax]');
    var headerHeight = $('header').height();

    var highlightCurrentLine = function () {
        // Highlight the active and neighboring lines for this frame:
        var activeLineNumber = +($activeLine.find('.frame-line').text());
        var $lines = $activeFrame.find('.linenums li');
        var firstLine = +($lines.first().val());

        $($lines[activeLineNumber - firstLine - 1]).addClass('current');
        $($lines[activeLineNumber - firstLine]).addClass('current active');
        $($lines[activeLineNumber - firstLine + 1]).addClass('current');
    }

    // Highlight the active for the first frame:
    highlightCurrentLine();

    $frameContainer.on('click', '.frame', function () {
        var $this = $(this);
        var id = /frame\-line\-([\d]*)/.exec($this.attr('id'))[1];
        var $codeFrame = $('#frame-code-' + id);

        if ($codeFrame) {
            $activeLine.removeClass('active');
            $activeFrame.removeClass('active');

            $this.addClass('active');
            $codeFrame.addClass('active');

            $activeLine = $this;
            $activeFrame = $codeFrame;

            highlightCurrentLine();

            $container.scrollTop(0);
        }
    });

    var clipboard = new Clipboard('.clipboard');
    var showTooltip = function (elem, msg) {
        elem.setAttribute('class', 'clipboard tooltipped tooltipped-s');
        elem.setAttribute('aria-label', msg);
    };

    clipboard.on('success', function (e) {
        e.clearSelection();

        showTooltip(e.trigger, 'Copied!');
    });

    clipboard.on('error', function (e) {
        showTooltip(e.trigger, fallbackMessage(e.action));
    });

    var btn = document.querySelector('.clipboard');

    btn.addEventListener('mouseleave', function (e) {
        e.currentTarget.setAttribute('class', 'clipboard');
        e.currentTarget.removeAttribute('aria-label');
    });

    function fallbackMessage(action) {
        var actionMsg = '';
        var actionKey = (action === 'cut' ? 'X' : 'C');

        if (/Mac/i.test(navigator.userAgent)) {
            actionMsg = 'Press ⌘-' + actionKey + ' to ' + action;
        } else {
            actionMsg = 'Press Ctrl-' + actionKey + ' to ' + action;
        }

        return actionMsg;
    }

    $(document).on('keydown', function (e) {
        if (e.ctrlKey) {
            // CTRL+Arrow-UP/Arrow-Down support:
            // 1) select the next/prev element
            // 2) make sure the newly selected element is within the view-scope
            // 3) focus the (right) container, so arrow-up/down (without ctrl) scroll the details
            if (e.which === 38 /* arrow up */) {
                $activeLine.prev('.frame').click();
                $activeLine[0].scrollIntoView();
                $container.focus();
                e.preventDefault();
            } else if (e.which === 40 /* arrow down */) {
                $activeLine.next('.frame').click();
                $activeLine[0].scrollIntoView();
                $container.focus();
                e.preventDefault();
            }
        }
    });

    // Avoid to quit the page with some protocol (e.g. IntelliJ Platform REST API)
    $ajaxEditors.on('click', function (e) {
        e.preventDefault();
        $.get(this.href);
    });

    // Symfony VarDumper: Close the by default expanded objects
    $('.sf-dump-expanded')
        .removeClass('sf-dump-expanded')
        .addClass('sf-dump-compact');
    $('.sf-dump-toggle span').html('&#9654;');
});