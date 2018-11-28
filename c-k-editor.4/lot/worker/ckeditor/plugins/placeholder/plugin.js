﻿/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
"use strict";!function(){CKEDITOR.plugins.add("placeholder",{requires:"widget,dialog",lang:"en,id",icons:"placeholder",hidpi:!0,onLoad:function(){CKEDITOR.addCss(".cke_placeholder{background-color:#ff0}")},init:function(e){var t=e.lang.placeholder;CKEDITOR.dialog.add("placeholder",this.path+"dialogs/placeholder.js"),e.widgets.add("placeholder",{dialog:"placeholder",pathName:t.pathName,template:'<span class="cke_placeholder">[[]]</span>',downcast:function(){return new CKEDITOR.htmlParser.text("[["+this.data.name+"]]")},init:function(){this.setData("name",this.element.getText().slice(2,-2))},data:function(){this.element.setText("[["+this.data.name+"]]")},getLabel:function(){return this.editor.lang.widget.label.replace(/%1/,this.data.name+" "+this.pathName)}}),e.ui.addButton&&e.ui.addButton("CreatePlaceholder",{label:t.toolbar,command:"placeholder",toolbar:"insert,5",icon:"placeholder"})},afterInit:function(e){var t=/\[\[([^\[\]])+\]\]/g;e.dataProcessor.dataFilter.addRules({text:function(n,a){var i=a.parent&&CKEDITOR.dtd[a.parent.name];if(!i||i.span)return n.replace(t,function(t){var n=null,a=new CKEDITOR.htmlParser.element("span",{"class":"cke_placeholder"});return a.add(new CKEDITOR.htmlParser.text(t)),n=e.widgets.wrapElement(a,"placeholder"),n.getOuterHtml()})}})}})}();