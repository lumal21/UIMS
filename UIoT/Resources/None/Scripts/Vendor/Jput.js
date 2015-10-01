/*
 * jQuery jPut Plug-in 1.1.6
 * http://plugins.jquery.com/jput/
 * Developed by Shabeer Ali M 
 * Email : shabeer@jput.org
 * Last Update : Multi jput with jrepeat
 */
(function ($) {
    $.fn.jPut = function (options) {
        var defaults = {
            name: "",
            jsonData: "",
            dataName: "",
            limit: 0,
            prepend: false,
            ajax_url: "",
            ajax_data: "",
            ajax_type: "GET",
            ajax_dataType: "json",
            ajax_jsonpCallback: "",
            done: function (e) {
            },
            error: function (e) {
            }
        };
        var options = $.extend({}, defaults, options);
        var html;
        try {
            function json_value(e, t) {
                if (e == "")return t;
                if (e.indexOf(".") == -1)return t[e];
                e = e.split(".");
                for (var n = 0; n < e.length; n++) {
                    t = t[e[n]]
                }
                return t
            }

            function getOperator(e) {
                operators = ["<=", ">=", "<", ">", "!=", "=="];
                for (i = 0; i < operators.length; i++)if (e.search(operators[i]) != -1)return operators[i]
            }

            function process(options) {
                var arr = options.jsonData;
                if (typeof arr != "object")arr = $.parseJSON(options.jsonData);
                if (typeof arr != "object")throw"Invalid JSON data!";
                arr = json_value(options.dataName, options.jsonData);
                if (arr == null)throw"JSON data is empty!";
                if (options.limit != 0)arr = arr.slice(0, options.limit);
                options.jsonData = arr;
                $.each(
                    arr, function (i, j) {
                        el1 = el.clone();
                        jrepeat = el.find("[jrepeat]").not("[jrepeat] [jrepeat]");
                        if (jrepeat.length > 0)jrepeat.each(function (e, t) {
                            $(this).attr("jrepeat-" + i, $(this).attr("jrepeat"))
                        });
                        el1_jrepeat = el1.find("[jrepeat]");
                        if (el1_jrepeat.length > 0)el1_jrepeat.each(function (e, t) {
                            $(this).remove()
                        });
                        var matches = el1.html().match(regExp);
                        html = el.html();
                        if (matches != null)$.each(
                            matches, function (index, value) {
                                var reg = new RegExp(value);
                                t = value.replace(/{{|}}/g, "");
                                t = t.replace("&gt;", ">");
                                t = t.replace("&lt;", "<");
                                var separators = ["\\?", "\\<=", "\\>=", "\\>", "\\<", "\\!=", "\\==", "\\:"];
                                c = decodeURI(t).split(new RegExp(separators.join("|"), "ig"));
                                if (c.length == 4) {
                                    condition = t.split("?");
                                    condition = getOperator(condition[0]);
                                    for (ci = 0; ci < 2; ci++)if (c[ci].substr(-1) + c[ci].charAt(0) != "''")c[ci] = "'" + escape(j[c[ci]]) + "'";
                                    for (ci = 2; ci < 4; ci++)if (c[ci].substr(-1) + c[ci].charAt(0) != "''")c[ci] = j[c[ci]];
                                    else c[ci] = c[ci].substr(1, c[ci].length - 2);
                                    console.log(c[0] + condition + c[1]);
                                    if (eval(c[0] + condition + c[1]))html = html.replace(value, unescape(c[2]));
                                    else html = html.replace(value, unescape(c[3]))
                                }
                                else {
                                    t = t.split("||");
                                    newval = json_value(t[0], j);
                                    if ((newval == "" || newval == undefined) && t.length != 1)html = html.replace(value, t[1]);
                                    else html = html.replace(value, json_value(t[0], j))
                                }
                            }
                        );
                        html = html.replace("jsrc", "src");
                        if (options.prepend == false)main.append(html);
                        else main.prepend(html);
                        if (jrepeat.length > 0) {
                            jrepeat.each(
                                function (e, t) {
                                    $("[jrepeat-" + i + '="' + $(this).attr("jrepeat") + '"]').jPut(
                                        {
                                            jsonData: j[$(this).attr("jrepeat")],
                                            name: $(this).attr("jrepeat"),
                                            error: function (e) {
                                                throw e
                                            }
                                        }
                                    )
                                }
                            )
                        }
                    }
                );
                $.isFunction(options.done) && options.done.call(this, options.jsonData)
            }

            $('[jput="' + options.name + '"],[jput]').hide();
            var main = $(this);
            var el = options.name == "" ? $("[jput]").clone() : $('[jput="' + options.name + '"]').clone();
            if (el.length == 0)throw"Cant find the jPut template (" + options.name + ")!";
            var regExp = /\{{([^}}]+)\}}/g;
            var matches = el.html().match(regExp);
            if (options.ajax_url != "") {
                $.ajax(
                    {
                        url: options.ajax_url,
                        data: options.ajax_data,
                        dataType: options.ajax_dataType,
                        jsonpCallback: options.ajax_jsonpCallback,
                        type: options.ajax_type,
                        success: function (e) {
                            options.jsonData = e;
                            process(options)
                        },
                        error: function (e) {
                        }
                    }
                )
            }
            else process(options)
        } catch (err) {
            $.isFunction(options.error) && options.error.call(this, err)
        }
        this.getValue = function (e) {
            return options.jsonData[e]
        };
        return this.each(function () {
        })
    }
})(jQuery)