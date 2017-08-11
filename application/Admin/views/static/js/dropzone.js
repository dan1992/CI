(function() {
	function a(f, d, g) {
		var b = a.resolve(f);
		if (null == b) {
			g = g || f;
			d = d || "root";
			var e = new Error('Failed to require "' + g + '" from "' + d + '"');
			e.path = g;
			e.parent = d;
			e.require = true;
			throw e
		}
		var c = a.modules[b];
		if (!c.exports) {
			c.exports = {};
			c.client = c.component = true;
			c.call(this, c.exports, a.relative(b), c)
		}
		return c.exports
	}
	a.modules = {};
	a.aliases = {};
	a.resolve = function(c) {
		if (c.charAt(0) === "/") {
			c = c.slice(1)
		}
		var d = [c, c + ".js", c + ".json", c + "/index.js", c + "/index.json"];
		for (var b = 0; b < d.length; b++) {
			var c = d[b];
			if (a.modules.hasOwnProperty(c)) {
				return c
			}
			if (a.aliases.hasOwnProperty(c)) {
				return a.aliases[c]
			}
		}
	};
	a.normalize = function(e, d) {
		var b = [];
		if ("." != d.charAt(0)) {
			return d
		}
		e = e.split("/");
		d = d.split("/");
		for (var c = 0; c < d.length; ++c) {
			if (".." == d[c]) {
				e.pop()
			} else {
				if ("." != d[c] && "" != d[c]) {
					b.push(d[c])
				}
			}
		}
		return e.concat(b).join("/")
	};
	a.register = function(c, b) {
		a.modules[c] = b
	};
	a.alias = function(c, b) {
		if (!a.modules.hasOwnProperty(c)) {
			throw new Error('Failed to alias "' + c + '", it does not exist')
		}
		a.aliases[b] = c
	};
	a.relative = function(c) {
		var e = a.normalize(c, "..");

		function b(f, h) {
			var g = f.length;
			while (g--) {
				if (f[g] === h) {
					return g
				}
			}
			return -1
		}
		function d(g) {
			var f = d.resolve(g);
			return a(f, c, g)
		}
		d.resolve = function(h) {
			var j = h.charAt(0);
			if ("/" == j) {
				return h.slice(1)
			}
			if ("." == j) {
				return a.normalize(e, h)
			}
			var f = c.split("/");
			var g = b(f, "deps") + 1;
			if (!g) {
				g = 0
			}
			h = f.slice(0, g + 1).join("/") + "/deps/" + h;
			return h
		};
		d.exists = function(f) {
			return a.modules.hasOwnProperty(d.resolve(f))
		};
		return d
	};
	a.register("component-emitter/index.js", function(c, d, e) {
		e.exports = f;

		function f(g) {
			if (g) {
				return b(g)
			}
		}
		function b(h) {
			for (var g in f.prototype) {
				h[g] = f.prototype[g]
			}
			return h
		}
		f.prototype.on = function(h, g) {
			this._callbacks = this._callbacks || {};
			(this._callbacks[h] = this._callbacks[h] || []).push(g);
			return this
		};
		f.prototype.once = function(j, i) {
			var h = this;
			this._callbacks = this._callbacks || {};

			function g() {
				h.off(j, g);
				i.apply(this, arguments)
			}
			i._off = g;
			this.on(j, g);
			return this
		};
		f.prototype.off = f.prototype.removeListener = f.prototype.removeAllListeners = function(k, h) {
			this._callbacks = this._callbacks || {};
			var j = this._callbacks[k];
			if (!j) {
				return this
			}
			if (1 == arguments.length) {
				delete this._callbacks[k];
				return this
			}
			var g = j.indexOf(h._off || h);
			if (~g) {
				j.splice(g, 1)
			}
			return this
		};
		f.prototype.emit = function(l) {
			this._callbacks = this._callbacks || {};
			var h = [].slice.call(arguments, 1),
				k = this._callbacks[l];
			if (k) {
				k = k.slice(0);
				for (var j = 0, g = k.length; j < g; ++j) {
					k[j].apply(this, h)
				}
			}
			return this
		};
		f.prototype.listeners = function(g) {
			this._callbacks = this._callbacks || {};
			return this._callbacks[g] || []
		};
		f.prototype.hasListeners = function(g) {
			return !!this.listeners(g).length
		}
	});
	a.register("dropzone/index.js", function(b, c, d) {
		d.exports = c("./lib/dropzone.js")
	});
	a.register("dropzone/lib/dropzone.js", function(b, c, d) {
		(function() {
			var j, f, e, g, m, l, k = {}.hasOwnProperty,
				h = function(q, o) {
					for (var n in o) {
						if (k.call(o, n)) {
							q[n] = o[n]
						}
					}
					function p() {
						this.constructor = q
					}
					p.prototype = o.prototype;
					q.prototype = new p();
					q.__super__ = o.prototype;
					return q
				},
				i = [].slice;
			f = typeof Emitter !== "undefined" && Emitter !== null ? Emitter : c("emitter");
			m = function() {};
			j = (function(o) {
				var p;
				h(n, o);
				n.prototype.events = ["drop", "dragstart", "dragend", "dragenter", "dragover", "dragleave", "selectedfiles", "addedfile", "removedfile", "thumbnail", "error", "processing", "processingmultiple", "uploadprogress", "totaluploadprogress", "sending", "sendingmultiple", "success", "successmultiple", "canceled", "canceledmultiple", "complete", "completemultiple", "reset", "maxfilesexceeded"];
				n.prototype.defaultOptions = {
					url: null,
					method: "post",
					withCredentials: false,
					parallelUploads: 2,
					uploadMultiple: false,
					maxFilesize: 256,
					paramName: "file",
					createImageThumbnails: true,
					maxThumbnailFilesize: 10,
					thumbnailWidth: 100,
					thumbnailHeight: 100,
					maxFiles: null,
					params: {},
					clickable: true,
					ignoreHiddenFiles: true,
					acceptedFiles: null,
					acceptedMimeTypes: null,
					autoProcessQueue: true,
					addRemoveLinks: false,
					previewsContainer: null,
					dictDefaultMessage: "Drop files here to upload",
					dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
					dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
					dictFileTooBig: "File is too big ({{filesize}}MB). Max filesize: {{maxFilesize}}MB.",
					dictInvalidFileType: "You can't upload files of this type.",
					dictResponseError: "Server responded with {{statusCode}} code.",
					dictCancelUpload: "Cancel upload",
					dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
					dictRemoveFile: "Remove file",
					dictRemoveFileConfirmation: null,
					dictMaxFilesExceeded: "You can only upload {{maxFiles}} files.",
					accept: function(r, q) {
						return q()
					},
					init: function() {
						return m
					},
					forceFallback: false,
					fallback: function() {
						var v, r, s, u, q, t;
						this.element.className = "" + this.element.className + " dz-browser-not-supported";
						t = this.element.getElementsByTagName("div");
						for (u = 0, q = t.length; u < q; u++) {
							v = t[u];
							if (/(^| )dz-message($| )/.test(v.className)) {
								r = v;
								v.className = "dz-message";
								continue
							}
						}
						if (!r) {
							r = n.createElement('<div class="dz-message"><span></span></div>');
							this.element.appendChild(r)
						}
						s = r.getElementsByTagName("span")[0];
						if (s) {
							s.textContent = this.options.dictFallbackMessage
						}
						return this.element.appendChild(this.getFallbackForm())
					},
					resize: function(r) {
						var t, s, q;
						t = {
							srcX: 0,
							srcY: 0,
							srcWidth: r.width,
							srcHeight: r.height
						};
						s = r.width / r.height;
						q = this.options.thumbnailWidth / this.options.thumbnailHeight;
						if (r.height < this.options.thumbnailHeight || r.width < this.options.thumbnailWidth) {
							t.trgHeight = t.srcHeight;
							t.trgWidth = t.srcWidth
						} else {
							if (s > q) {
								t.srcHeight = r.height;
								t.srcWidth = t.srcHeight * q
							} else {
								t.srcWidth = r.width;
								t.srcHeight = t.srcWidth / q
							}
						}
						t.srcX = (r.width - t.srcWidth) / 2;
						t.srcY = (r.height - t.srcHeight) / 2;
						return t
					},
					drop: function(q) {
						return this.element.classList.remove("dz-drag-hover")
					},
					dragstart: m,
					dragend: function(q) {
						return this.element.classList.remove("dz-drag-hover")
					},
					dragenter: function(q) {
						return this.element.classList.add("dz-drag-hover")
					},
					dragover: function(q) {
						return this.element.classList.add("dz-drag-hover")
					},
					dragleave: function(q) {
						return this.element.classList.remove("dz-drag-hover")
					},
					selectedfiles: function(q) {
						if (this.element === this.previewsContainer) {
							return this.element.classList.add("dz-started")
						}
					},
					reset: function() {
						return this.element.classList.remove("dz-started")
					},
					addedfile: function(q) {
						var r = this;
						q.previewElement = n.createElement(this.options.previewTemplate);
						q.previewTemplate = q.previewElement;
						this.previewsContainer.appendChild(q.previewElement);
						q.previewElement.querySelector("[data-dz-name]").textContent = q.name;
						q.previewElement.querySelector("[data-dz-size]").innerHTML = this.filesize(q.size);
						if (this.options.addRemoveLinks) {
							q._removeLink = n.createElement('<a class="dz-remove" href="javascript:undefined;">' + this.options.dictRemoveFile + "</a>");
							q._removeLink.addEventListener("click", function(s) {
								s.preventDefault();
								s.stopPropagation();
								if (q.status === n.UPLOADING) {
									return n.confirm(r.options.dictCancelUploadConfirmation, function() {
										return r.removeFile(q)
									})
								} else {
									if (r.options.dictRemoveFileConfirmation) {
										return n.confirm(r.options.dictRemoveFileConfirmation, function() {
											return r.removeFile(q)
										})
									} else {
										return r.removeFile(q)
									}
								}
							});
							q.previewElement.appendChild(q._removeLink)
						}
						return this._updateMaxFilesReachedClass()
					},
					removedfile: function(q) {
						var r;
						if ((r = q.previewElement) != null) {
							r.parentNode.removeChild(q.previewElement)
						}
						return this._updateMaxFilesReachedClass()
					},
					thumbnail: function(r, s) {
						var q;
						r.previewElement.classList.remove("dz-file-preview");
						r.previewElement.classList.add("dz-image-preview");
						q = r.previewElement.querySelector("[data-dz-thumbnail]");
						q.alt = r.name;
						return q.src = s
					},
					error: function(q, r) {
						q.previewElement.classList.add("dz-error");
						return q.previewElement.querySelector("[data-dz-errormessage]").textContent = r
					},
					processing: function(q) {
						q.previewElement.classList.add("dz-processing");
						if (q._removeLink) {
							return q._removeLink.textContent = this.options.dictCancelUpload
						}
					},
					processingmultiple: m,
					uploadprogress: function(s, q, r) {
						return s.previewElement.querySelector("[data-dz-uploadprogress]").style.width = "" + q + "%"
					},
					totaluploadprogress: m,
					sending: m,
					sendingmultiple: m,
					success: function(q) {
						return q.previewElement.classList.add("dz-success")
					},
					successmultiple: m,
					canceled: function(q) {
						return this.emit("error", q, "Upload canceled.")
					},
					canceledmultiple: m,
					complete: function(q) {
						if (q._removeLink) {
							return q._removeLink.textContent = this.options.dictRemoveFile
						}
					},
					completemultiple: m,
					maxfilesexceeded: m,
					previewTemplate: '<div class="dz-preview dz-file-preview">\n  <div class="dz-details">\n    <div class="dz-filename"><span data-dz-name></span></div>\n    <div class="dz-size" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n  <div class="dz-success-mark"><span>鉁�/span></div>\n  <div class="dz-error-mark"><span>鉁�/span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n</div>'
				};
				p = function() {
					var s, r, u, v, w, t, q;
					v = arguments[0], u = 2 <= arguments.length ? i.call(arguments, 1) : [];
					for (t = 0, q = u.length; t < q; t++) {
						r = u[t];
						for (s in r) {
							w = r[s];
							v[s] = w
						}
					}
					return v
				};

				function n(s, r) {
					var q, u, t;
					this.element = s;
					this.version = n.version;
					this.defaultOptions.previewTemplate = this.defaultOptions.previewTemplate.replace(/\n*/g, "");
					this.clickableElements = [];
					this.listeners = [];
					this.files = [];
					if (typeof this.element === "string") {
						this.element = document.querySelector(this.element)
					}
					if (!(this.element && (this.element.nodeType != null))) {
						throw new Error("Invalid dropzone element.")
					}
					if (this.element.dropzone) {
						throw new Error("Dropzone already attached.")
					}
					n.instances.push(this);
					s.dropzone = this;
					q = (t = n.optionsForElement(this.element)) != null ? t : {};
					this.options = p({}, this.defaultOptions, q, r != null ? r : {});
					if (this.options.forceFallback || !n.isBrowserSupported()) {
						return this.options.fallback.call(this)
					}
					if (this.options.url == null) {
						this.options.url = this.element.getAttribute("action")
					}
					if (!this.options.url) {
						throw new Error("No URL provided.")
					}
					if (this.options.acceptedFiles && this.options.acceptedMimeTypes) {
						throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.")
					}
					if (this.options.acceptedMimeTypes) {
						this.options.acceptedFiles = this.options.acceptedMimeTypes;
						delete this.options.acceptedMimeTypes
					}
					this.options.method = this.options.method.toUpperCase();
					if ((u = this.getExistingFallback()) && u.parentNode) {
						u.parentNode.removeChild(u)
					}
					if (this.options.previewsContainer) {
						this.previewsContainer = n.getElement(this.options.previewsContainer, "previewsContainer")
					} else {
						this.previewsContainer = this.element
					}
					if (this.options.clickable) {
						if (this.options.clickable === true) {
							this.clickableElements = [this.element]
						} else {
							this.clickableElements = n.getElements(this.options.clickable, "clickable")
						}
					}
					this.init()
				}
				n.prototype.getAcceptedFiles = function() {
					var s, u, r, t, q;
					t = this.files;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						if (s.accepted) {
							q.push(s)
						}
					}
					return q
				};
				n.prototype.getRejectedFiles = function() {
					var s, u, r, t, q;
					t = this.files;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						if (!s.accepted) {
							q.push(s)
						}
					}
					return q
				};
				n.prototype.getQueuedFiles = function() {
					var s, u, r, t, q;
					t = this.files;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						if (s.status === n.QUEUED) {
							q.push(s)
						}
					}
					return q
				};
				n.prototype.getUploadingFiles = function() {
					var s, u, r, t, q;
					t = this.files;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						if (s.status === n.UPLOADING) {
							q.push(s)
						}
					}
					return q
				};
				n.prototype.init = function() {
					var s, w, v, u, r, t, q, x = this;
					if (this.element.tagName === "form") {
						this.element.setAttribute("enctype", "multipart/form-data")
					}
					if (this.element.classList.contains("dropzone") && !this.element.querySelector(".dz-message")) {
						this.element.appendChild(n.createElement('<div class="dz-default dz-message"><span>' + this.options.dictDefaultMessage + "</span></div>"))
					}
					if (this.clickableElements.length) {
						v = function() {
							if (x.hiddenFileInput) {
								document.body.removeChild(x.hiddenFileInput)
							}
							x.hiddenFileInput = document.createElement("input");
							x.hiddenFileInput.setAttribute("type", "file");
							x.hiddenFileInput.setAttribute("multiple", "multiple");
							if (x.options.acceptedFiles != null) {
								x.hiddenFileInput.setAttribute("accept", x.options.acceptedFiles)
							}
							x.hiddenFileInput.style.visibility = "hidden";
							x.hiddenFileInput.style.position = "absolute";
							x.hiddenFileInput.style.top = "0";
							x.hiddenFileInput.style.left = "0";
							x.hiddenFileInput.style.height = "0";
							x.hiddenFileInput.style.width = "0";
							document.body.appendChild(x.hiddenFileInput);
							return x.hiddenFileInput.addEventListener("change", function() {
								var y;
								y = x.hiddenFileInput.files;
								if (y.length) {
									x.emit("selectedfiles", y);
									x.handleFiles(y)
								}
								return v()
							})
						};
						v()
					}
					this.URL = (t = window.URL) != null ? t : window.webkitURL;
					q = this.events;
					for (u = 0, r = q.length; u < r; u++) {
						s = q[u];
						this.on(s, this.options[s])
					}
					this.on("uploadprogress", function() {
						return x.updateTotalUploadProgress()
					});
					this.on("removedfile", function() {
						return x.updateTotalUploadProgress()
					});
					this.on("canceled", function(y) {
						return x.emit("complete", y)
					});
					w = function(y) {
						y.stopPropagation();
						if (y.preventDefault) {
							return y.preventDefault()
						} else {
							return y.returnValue = false
						}
					};
					this.listeners = [{
						element: this.element,
						events: {
							dragstart: function(y) {
								return x.emit("dragstart", y)
							},
							dragenter: function(y) {
								w(y);
								return x.emit("dragenter", y)
							},
							dragover: function(y) {
								w(y);
								return x.emit("dragover", y)
							},
							dragleave: function(y) {
								return x.emit("dragleave", y)
							},
							drop: function(y) {
								w(y);
								x.drop(y);
								return x.emit("drop", y)
							},
							dragend: function(y) {
								return x.emit("dragend", y)
							}
						}
					}];
					this.clickableElements.forEach(function(y) {
						return x.listeners.push({
							element: y,
							events: {
								click: function(z) {
									if ((y !== x.element) || (z.target === x.element || n.elementInside(z.target, x.element.querySelector(".dz-message")))) {
										return x.hiddenFileInput.click()
									}
								}
							}
						})
					});
					this.enable();
					return this.options.init.call(this)
				};
				n.prototype.destroy = function() {
					var q;
					this.disable();
					this.removeAllFiles(true);
					if ((q = this.hiddenFileInput) != null ? q.parentNode : void 0) {
						this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput);
						this.hiddenFileInput = null
					}
					return delete this.element.dropzone
				};
				n.prototype.updateTotalUploadProgress = function() {
					var r, t, x, q, w, v, s, u;
					q = 0;
					x = 0;
					r = this.getAcceptedFiles();
					if (r.length) {
						u = this.getAcceptedFiles();
						for (v = 0, s = u.length; v < s; v++) {
							t = u[v];
							q += t.upload.bytesSent;
							x += t.upload.total
						}
						w = 100 * q / x
					} else {
						w = 100
					}
					return this.emit("totaluploadprogress", w, x, q)
				};
				n.prototype.getFallbackForm = function() {
					var r, q, t, s;
					if (r = this.getExistingFallback()) {
						return r
					}
					t = '<div class="dz-fallback">';
					if (this.options.dictFallbackText) {
						t += "<p>" + this.options.dictFallbackText + "</p>"
					}
					t += '<input type="file" name="' + this.options.paramName + (this.options.uploadMultiple ? "[]" : "") + '" ' + (this.options.uploadMultiple ? 'multiple="multiple"' : void 0) + ' /><button type="submit">Upload!</button></div>';
					q = n.createElement(t);
					if (this.element.tagName !== "FORM") {
						s = n.createElement('<form action="' + this.options.url + '" enctype="multipart/form-data" method="' + this.options.method + '"></form>');
						s.appendChild(q)
					} else {
						this.element.setAttribute("enctype", "multipart/form-data");
						this.element.setAttribute("method", this.options.method)
					}
					return s != null ? s : q
				};
				n.prototype.getExistingFallback = function() {
					var v, s, r, u, q, t;
					s = function(z) {
						var x, y, w;
						for (y = 0, w = z.length; y < w; y++) {
							x = z[y];
							if (/(^| )fallback($| )/.test(x.className)) {
								return x
							}
						}
					};
					t = ["div", "form"];
					for (u = 0, q = t.length; u < q; u++) {
						r = t[u];
						if (v = s(this.element.getElementsByTagName(r))) {
							return v
						}
					}
				};
				n.prototype.setupEventListeners = function() {
					var t, s, w, v, r, u, q;
					u = this.listeners;
					q = [];
					for (v = 0, r = u.length; v < r; v++) {
						t = u[v];
						q.push((function() {
							var x, y;
							x = t.events;
							y = [];
							for (s in x) {
								w = x[s];
								y.push(t.element.addEventListener(s, w, false))
							}
							return y
						})())
					}
					return q
				};
				n.prototype.removeEventListeners = function() {
					var t, s, w, v, r, u, q;
					u = this.listeners;
					q = [];
					for (v = 0, r = u.length; v < r; v++) {
						t = u[v];
						q.push((function() {
							var x, y;
							x = t.events;
							y = [];
							for (s in x) {
								w = x[s];
								y.push(t.element.removeEventListener(s, w, false))
							}
							return y
						})())
					}
					return q
				};
				n.prototype.disable = function() {
					var s, u, r, t, q;
					this.clickableElements.forEach(function(v) {
						return v.classList.remove("dz-clickable")
					});
					this.removeEventListeners();
					t = this.files;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						q.push(this.cancelUpload(s))
					}
					return q
				};
				n.prototype.enable = function() {
					this.clickableElements.forEach(function(q) {
						return q.classList.add("dz-clickable")
					});
					return this.setupEventListeners()
				};
				n.prototype.filesize = function(r) {
					var q;
					if (r >= 100000000000) {
						r = r / 100000000000;
						q = "TB"
					} else {
						if (r >= 100000000) {
							r = r / 100000000;
							q = "GB"
						} else {
							if (r >= 100000) {
								r = r / 100000;
								q = "MB"
							} else {
								if (r >= 100) {
									r = r / 100;
									q = "KB"
								} else {
									r = r * 10;
									q = "b"
								}
							}
						}
					}
					return "<strong>" + (Math.round(r) / 10) + "</strong> " + q
				};
				n.prototype._updateMaxFilesReachedClass = function() {
					if (this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles) {
						return this.element.classList.add("dz-max-files-reached")
					} else {
						return this.element.classList.remove("dz-max-files-reached")
					}
				};
				n.prototype.drop = function(s) {
					var r, q;
					if (!s.dataTransfer) {
						return
					}
					r = s.dataTransfer.files;
					this.emit("selectedfiles", r);
					if (r.length) {
						q = s.dataTransfer.items;
						if (q && q.length && ((q[0].webkitGetAsEntry != null) || (q[0].getAsEntry != null))) {
							this.handleItems(q)
						} else {
							this.handleFiles(r)
						}
					}
				};
				n.prototype.handleFiles = function(t) {
					var s, u, r, q;
					q = [];
					for (u = 0, r = t.length; u < r; u++) {
						s = t[u];
						q.push(this.addFile(s))
					}
					return q
				};
				n.prototype.handleItems = function(r) {
					var t, s, u, q;
					for (u = 0, q = r.length; u < q; u++) {
						s = r[u];
						if (s.webkitGetAsEntry != null) {
							t = s.webkitGetAsEntry();
							if (t.isFile) {
								this.addFile(s.getAsFile())
							} else {
								if (t.isDirectory) {
									this.addDirectory(t, t.name)
								}
							}
						} else {
							this.addFile(s.getAsFile())
						}
					}
				};
				n.prototype.accept = function(r, q) {
					if (r.size > this.options.maxFilesize * 1024 * 1024) {
						return q(this.options.dictFileTooBig.replace("{{filesize}}", Math.round(r.size / 1024 / 10.24) / 100).replace("{{maxFilesize}}", this.options.maxFilesize))
					} else {
						if (!n.isValidFile(r, this.options.acceptedFiles)) {
							return q(this.options.dictInvalidFileType)
						} else {
							if (this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles) {
								q(this.options.dictMaxFilesExceeded.replace("{{maxFiles}}", this.options.maxFiles));
								return this.emit("maxfilesexceeded", r)
							} else {
								return this.options.accept.call(this, r, q)
							}
						}
					}
				};
				n.prototype.addFile = function(q) {
					var r = this;
					q.upload = {
						progress: 0,
						total: q.size,
						bytesSent: 0
					};
					this.files.push(q);
					q.status = n.ADDED;
					this.emit("addedfile", q);
					if (this.options.createImageThumbnails && q.type.match(/image.*/) && q.size <= this.options.maxThumbnailFilesize * 1024 * 1024) {
						this.createThumbnail(q)
					}
					return this.accept(q, function(s) {
						if (s) {
							q.accepted = false;
							return r._errorProcessing([q], s)
						} else {
							return r.enqueueFile(q)
						}
					})
				};
				n.prototype.enqueueFiles = function(s) {
					var r, t, q;
					for (t = 0, q = s.length; t < q; t++) {
						r = s[t];
						this.enqueueFile(r)
					}
					return null
				};
				n.prototype.enqueueFile = function(q) {
					var r = this;
					q.accepted = true;
					if (q.status === n.ADDED) {
						q.status = n.QUEUED;
						if (this.options.autoProcessQueue) {
							return setTimeout((function() {
								return r.processQueue()
							}), 1)
						}
					} else {
						throw new Error("This file can't be queued because it has already been processed or was rejected.")
					}
				};
				n.prototype.addDirectory = function(r, s) {
					var q, u, t = this;
					q = r.createReader();
					u = function(v) {
						var x, w;
						for (x = 0, w = v.length; x < w; x++) {
							r = v[x];
							if (r.isFile) {
								r.file(function(y) {
									if (t.options.ignoreHiddenFiles && y.name.substring(0, 1) === ".") {
										return
									}
									y.fullPath = "" + s + "/" + y.name;
									return t.addFile(y)
								})
							} else {
								if (r.isDirectory) {
									t.addDirectory(r, "" + s + "/" + r.name)
								}
							}
						}
					};
					return q.readEntries(u, function(v) {
						return typeof console !== "undefined" && console !== null ? typeof console.log === "function" ? console.log(v) : void 0 : void 0
					})
				};
				n.prototype.removeFile = function(q) {
					if (q.status === n.UPLOADING) {
						this.cancelUpload(q)
					}
					this.files = l(this.files, q);
					this.emit("removedfile", q);
					if (this.files.length === 0) {
						return this.emit("reset")
					}
				};
				n.prototype.removeAllFiles = function(u) {
					var r, t, q, s;
					if (u == null) {
						u = false
					}
					s = this.files.slice();
					for (t = 0, q = s.length; t < q; t++) {
						r = s[t];
						if (r.status !== n.UPLOADING || u) {
							this.removeFile(r)
						}
					}
					return null
				};
				n.prototype.createThumbnail = function(r) {
					var q, s = this;
					q = new FileReader;
					q.onload = function() {
						var t;
						t = new Image;
						t.onload = function() {
							var w, v, z, B, x, u, A, y;
							r.width = t.width;
							r.height = t.height;
							z = s.options.resize.call(s, r);
							if (z.trgWidth == null) {
								z.trgWidth = s.options.thumbnailWidth
							}
							if (z.trgHeight == null) {
								z.trgHeight = s.options.thumbnailHeight
							}
							w = document.createElement("canvas");
							v = w.getContext("2d");
							w.width = z.trgWidth;
							w.height = z.trgHeight;
							v.drawImage(t, (x = z.srcX) != null ? x : 0, (u = z.srcY) != null ? u : 0, z.srcWidth, z.srcHeight, (A = z.trgX) != null ? A : 0, (y = z.trgY) != null ? y : 0, z.trgWidth, z.trgHeight);
							B = w.toDataURL("image/png");
							return s.emit("thumbnail", r, B)
						};
						return t.src = q.result
					};
					return q.readAsDataURL(r)
				};
				n.prototype.processQueue = function() {
					var r, t, q, s;
					t = this.options.parallelUploads;
					q = this.getUploadingFiles().length;
					r = q;
					if (q >= t) {
						return
					}
					s = this.getQueuedFiles();
					if (!(s.length > 0)) {
						return
					}
					if (this.options.uploadMultiple) {
						return this.processFiles(s.slice(0, t - q))
					} else {
						while (r < t) {
							if (!s.length) {
								return
							}
							this.processFile(s.shift());
							r++
						}
					}
				};
				n.prototype.processFile = function(q) {
					return this.processFiles([q])
				};
				n.prototype.processFiles = function(s) {
					var r, t, q;
					for (t = 0, q = s.length; t < q; t++) {
						r = s[t];
						r.processing = true;
						r.status = n.UPLOADING;
						this.emit("processing", r)
					}
					if (this.options.uploadMultiple) {
						this.emit("processingmultiple", s)
					}
					return this.uploadFiles(s)
				};
				n.prototype._getFilesWithXhr = function(s) {
					var q, r;
					return r = (function() {
						var w, u, v, t;
						v = this.files;
						t = [];
						for (w = 0, u = v.length; w < u; w++) {
							q = v[w];
							if (q.xhr === s) {
								t.push(q)
							}
						}
						return t
					}).call(this)
				};
				n.prototype.cancelUpload = function(u) {
					var s, t, x, v, r, q, w;
					if (u.status === n.UPLOADING) {
						t = this._getFilesWithXhr(u.xhr);
						for (x = 0, r = t.length; x < r; x++) {
							s = t[x];
							s.status = n.CANCELED
						}
						u.xhr.abort();
						for (v = 0, q = t.length; v < q; v++) {
							s = t[v];
							this.emit("canceled", s)
						}
						if (this.options.uploadMultiple) {
							this.emit("canceledmultiple", t)
						}
					} else {
						if ((w = u.status) === n.ADDED || w === n.QUEUED) {
							u.status = n.CANCELED;
							this.emit("canceled", u);
							if (this.options.uploadMultiple) {
								this.emit("canceledmultiple", [u])
							}
						}
					}
					if (this.options.autoProcessQueue) {
						return this.processQueue()
					}
				};
				n.prototype.uploadFile = function(q) {
					return this.uploadFiles([q])
				};
				n.prototype.uploadFiles = function(z) {
					var N, M, E, I, B, w, H, D, J, S, A, r, F, K, C, v, t, s, q, P, R, Q, O, G, y, x, u, L = this;
					C = new XMLHttpRequest();
					for (v = 0, P = z.length; v < P; v++) {
						N = z[v];
						N.xhr = C
					}
					C.open(this.options.method, this.options.url, true);
					C.withCredentials = !! this.options.withCredentials;
					r = null;
					E = function() {
						var V, U, T;
						T = [];
						for (V = 0, U = z.length; V < U; V++) {
							N = z[V];
							T.push(L._errorProcessing(z, r || L.options.dictResponseError.replace("{{statusCode}}", C.status), C))
						}
						return T
					};
					F = function(ac) {
						var X, U, ab, Z, Y, W, V, T, aa;
						if (ac != null) {
							U = 100 * ac.loaded / ac.total;
							for (ab = 0, W = z.length; ab < W; ab++) {
								N = z[ab];
								N.upload = {
									progress: U,
									total: ac.total,
									bytesSent: ac.loaded
								}
							}
						} else {
							X = true;
							U = 100;
							for (Z = 0, V = z.length; Z < V; Z++) {
								N = z[Z];
								if (!(N.upload.progress === 100 && N.upload.bytesSent === N.upload.total)) {
									X = false
								}
								N.upload.progress = U;
								N.upload.bytesSent = N.upload.total
							}
							if (X) {
								return
							}
						}
						aa = [];
						for (Y = 0, T = z.length; Y < T; Y++) {
							N = z[Y];
							aa.push(L.emit("uploadprogress", N, U, N.upload.bytesSent))
						}
						return aa
					};
					C.onload = function(U) {
						var T;
						if (z[0].status === n.CANCELED) {
							return
						}
						if (C.readyState !== 4) {
							return
						}
						r = C.responseText;
						if (C.getResponseHeader("content-type") && ~C.getResponseHeader("content-type").indexOf("application/json")) {
							try {
								r = JSON.parse(r)
							} catch (V) {
								U = V;
								r = "Invalid JSON response from server."
							}
						}
						F();
						if (!((200 <= (T = C.status) && T < 300))) {
							return E()
						} else {
							return L._finished(z, r, U)
						}
					};
					C.onerror = function() {
						if (z[0].status === n.CANCELED) {
							return
						}
						return E()
					};
					A = (G = C.upload) != null ? G : C;
					A.onprogress = F;
					w = {
						Accept: "application/json",
						"Cache-Control": "no-cache",
						"X-Requested-With": "XMLHttpRequest"
					};
					if (this.options.headers) {
						p(w, this.options.headers)
					}
					for (I in w) {
						B = w[I];
						C.setRequestHeader(I, B)
					}
					M = new FormData();
					if (this.options.params) {
						y = this.options.params;
						for (S in y) {
							K = y[S];
							M.append(S, K)
						}
					}
					for (t = 0, R = z.length; t < R; t++) {
						N = z[t];
						this.emit("sending", N, C, M)
					}
					if (this.options.uploadMultiple) {
						this.emit("sendingmultiple", z, C, M)
					}
					if (this.element.tagName === "FORM") {
						x = this.element.querySelectorAll("input, textarea, select, button");
						for (s = 0, Q = x.length; s < Q; s++) {
							H = x[s];
							D = H.getAttribute("name");
							J = H.getAttribute("type");
							if (!J || ((u = J.toLowerCase()) !== "checkbox" && u !== "radio") || H.checked) {
								M.append(D, H.value)
							}
						}
					}
					for (q = 0, O = z.length; q < O; q++) {
						N = z[q];
						M.append("" + this.options.paramName + (this.options.uploadMultiple ? "[]" : ""), N, N.name)
					}
					return C.send(M)
				};
				n.prototype._finished = function(s, u, v) {
					var r, t, q;
					for (t = 0, q = s.length; t < q; t++) {
						r = s[t];
						r.status = n.SUCCESS;
						this.emit("success", r, u, v);
						this.emit("complete", r)
					}
					if (this.options.uploadMultiple) {
						this.emit("successmultiple", s, u, v);
						this.emit("completemultiple", s)
					}
					if (this.options.autoProcessQueue) {
						return this.processQueue()
					}
				};
				n.prototype._errorProcessing = function(t, s, v) {
					var r, u, q;
					for (u = 0, q = t.length; u < q; u++) {
						r = t[u];
						r.status = n.ERROR;
						this.emit("error", r, s, v);
						this.emit("complete", r)
					}
					if (this.options.uploadMultiple) {
						this.emit("errormultiple", t, s, v);
						this.emit("completemultiple", t)
					}
					if (this.options.autoProcessQueue) {
						return this.processQueue()
					}
				};
				return n
			})(f);
			j.version = "3.7.0";
			j.options = {};
			j.optionsForElement = function(n) {
				if (n.id) {
					return j.options[e(n.id)]
				} else {
					return void 0
				}
			};
			j.instances = [];
			j.forElement = function(n) {
				if (typeof n === "string") {
					n = document.querySelector(n)
				}
				if ((n != null ? n.dropzone : void 0) == null) {
					throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.")
				}
				return n.dropzone
			};
			j.autoDiscover = true;
			j.discover = function() {
				var s, p, q, r, o, n;
				if (document.querySelectorAll) {
					q = document.querySelectorAll(".dropzone")
				} else {
					q = [];
					s = function(x) {
						var v, w, u, t;
						t = [];
						for (w = 0, u = x.length; w < u; w++) {
							v = x[w];
							if (/(^| )dropzone($| )/.test(v.className)) {
								t.push(q.push(v))
							} else {
								t.push(void 0)
							}
						}
						return t
					};
					s(document.getElementsByTagName("div"));
					s(document.getElementsByTagName("form"))
				}
				n = [];
				for (r = 0, o = q.length; r < o; r++) {
					p = q[r];
					if (j.optionsForElement(p) !== false) {
						n.push(new j(p))
					} else {
						n.push(void 0)
					}
				}
				return n
			};
			j.blacklistedBrowsers = [/opera.*Macintosh.*version\/12/i];
			j.isBrowserSupported = function() {
				var o, p, r, n, q;
				o = true;
				if (window.File && window.FileReader && window.FileList && window.Blob && window.FormData && document.querySelector) {
					if (!("classList" in document.createElement("a"))) {
						o = false
					} else {
						q = j.blacklistedBrowsers;
						for (r = 0, n = q.length; r < n; r++) {
							p = q[r];
							if (p.test(navigator.userAgent)) {
								o = false;
								continue
							}
						}
					}
				} else {
					o = false
				}
				return o
			};
			l = function(s, p) {
				var q, r, o, n;
				n = [];
				for (r = 0, o = s.length; r < o; r++) {
					q = s[r];
					if (q !== p) {
						n.push(q)
					}
				}
				return n
			};
			e = function(n) {
				return n.replace(/[\-_](\w)/g, function(o) {
					return o[1].toUpperCase()
				})
			};
			j.createElement = function(n) {
				var o;
				o = document.createElement("div");
				o.innerHTML = n;
				return o.childNodes[0]
			};
			j.elementInside = function(o, n) {
				if (o === n) {
					return true
				}
				while (o = o.parentNode) {
					if (o === n) {
						return true
					}
				}
				return false
			};
			j.getElement = function(p, n) {
				var o;
				if (typeof p === "string") {
					o = document.querySelector(p)
				} else {
					if (p.nodeType != null) {
						o = p
					}
				}
				if (o == null) {
					throw new Error("Invalid `" + n + "` option provided. Please provide a CSS selector or a plain HTML element.")
				}
				return o
			};
			j.getElements = function(t, o) {
				var v, q, n, s, r, w, p, u;
				if (t instanceof Array) {
					n = [];
					try {
						for (s = 0, w = t.length; s < w; s++) {
							q = t[s];
							n.push(this.getElement(q, o))
						}
					} catch (x) {
						v = x;
						n = null
					}
				} else {
					if (typeof t === "string") {
						n = [];
						u = document.querySelectorAll(t);
						for (r = 0, p = u.length; r < p; r++) {
							q = u[r];
							n.push(q)
						}
					} else {
						if (t.nodeType != null) {
							n = [t]
						}
					}
				}
				if (!((n != null) && n.length)) {
					throw new Error("Invalid `" + o + "` option provided. Please provide a CSS selector, a plain HTML element or a list of those.")
				}
				return n
			};
			j.confirm = function(n, p, o) {
				if (window.confirm(n)) {
					return p()
				} else {
					if (o != null) {
						return o()
					}
				}
			};
			j.isValidFile = function(q, n) {
				var p, t, r, s, o;
				if (!n) {
					return true
				}
				n = n.split(",");
				t = q.type;
				p = t.replace(/\/.*$/, "");
				for (s = 0, o = n.length; s < o; s++) {
					r = n[s];
					r = r.trim();
					if (r.charAt(0) === ".") {
						if (q.name.indexOf(r, q.name.length - r.length) !== -1) {
							return true
						}
					} else {
						if (/\/\*$/.test(r)) {
							if (p === r.replace(/\/.*$/, "")) {
								return true
							}
						} else {
							if (t === r) {
								return true
							}
						}
					}
				}
				return false
			};
			if (typeof jQuery !== "undefined" && jQuery !== null) {
				jQuery.fn.dropzone = function(n) {
					return this.each(function() {
						return new j(this, n)
					})
				}
			}
			if (typeof d !== "undefined" && d !== null) {
				d.exports = j
			} else {
				window.Dropzone = j
			}
			j.ADDED = "added";
			j.QUEUED = "queued";
			j.ACCEPTED = j.QUEUED;
			j.UPLOADING = "uploading";
			j.PROCESSING = j.UPLOADING;
			j.CANCELED = "canceled";
			j.ERROR = "error";
			j.SUCCESS = "success";
			g = function(p, t) {
				var y, u, o, x, q, n, w, s, r;
				o = false;
				r = true;
				u = p.document;
				s = u.documentElement;
				y = (u.addEventListener ? "addEventListener" : "attachEvent");
				w = (u.addEventListener ? "removeEventListener" : "detachEvent");
				n = (u.addEventListener ? "" : "on");
				x = function(z) {
					if (z.type === "readystatechange" && u.readyState !== "complete") {
						return
					}(z.type === "load" ? p : u)[w](n + z.type, x, false);
					if (!o && (o = true)) {
						return t.call(p, z.type || z)
					}
				};
				q = function() {
					var z;
					try {
						s.doScroll("left")
					} catch (A) {
						z = A;
						setTimeout(q, 50);
						return
					}
					return x("poll")
				};
				if (u.readyState !== "complete") {
					if (u.createEventObject && s.doScroll) {
						try {
							r = !p.frameElement
						} catch (v) {}
						if (r) {
							q()
						}
					}
					u[y](n + "DOMContentLoaded", x, false);
					u[y](n + "readystatechange", x, false);
					return p[y](n + "load", x, false)
				}
			};
			j._autoDiscoverFunction = function() {
				if (j.autoDiscover) {
					return j.discover()
				}
			};
			g(window, j._autoDiscoverFunction)
		}).call(this)
	});
	a.alias("component-emitter/index.js", "dropzone/deps/emitter/index.js");
	a.alias("component-emitter/index.js", "emitter/index.js");
	if (typeof exports == "object") {
		module.exports = a("dropzone")
	} else {
		if (typeof define == "function" && define.amd) {
			define(function() {
				return a("dropzone")
			})
		} else {
			this["Dropzone"] = a("dropzone")
		}
	}
})();