window['PR_SHOULD_USE_CONTINUATION']=true;window['PR_TAB_WIDTH']=8;window['PR_normalizedHtml']=window['PR']=window['prettyPrintOne']=window['prettyPrint']=void 0;window['_pr_isIE6']=function(){var ieVersion=navigator&&navigator.userAgent&&navigator.userAgent.match(/\bMSIE ([678])\./);ieVersion=ieVersion?+ieVersion[1]:false;window['_pr_isIE6']=function(){return ieVersion;};return ieVersion;};(function(){var FLOW_CONTROL_KEYWORDS="break continue do else for if return while ";var C_KEYWORDS=FLOW_CONTROL_KEYWORDS+"auto case char const default "+"double enum extern float goto int long register short signed sizeof "+"static struct switch typedef union unsigned void volatile ";var COMMON_KEYWORDS=C_KEYWORDS+"catch class delete false import "+"new operator private protected public this throw true try typeof ";var CPP_KEYWORDS=COMMON_KEYWORDS+"alignof align_union asm axiom bool "+"concept concept_map const_cast constexpr decltype "+"dynamic_cast explicit export friend inline late_check "+"mutable namespace nullptr reinterpret_cast static_assert static_cast "+"template typeid typename using virtual wchar_t where ";var JAVA_KEYWORDS=COMMON_KEYWORDS+"abstract boolean byte extends final finally implements import "+"instanceof null native package strictfp super synchronized throws "+"transient ";var CSHARP_KEYWORDS=JAVA_KEYWORDS+"as base by checked decimal delegate descending event "+"fixed foreach from group implicit in interface internal into is lock "+"object out override orderby params partial readonly ref sbyte sealed "+"stackalloc string select uint ulong unchecked unsafe ushort var ";var JSCRIPT_KEYWORDS=COMMON_KEYWORDS+"debugger eval export function get null set undefined var with "+"Infinity NaN ";var PERL_KEYWORDS="caller delete die do dump elsif eval exit foreach for "+"goto if import last local my next no our print package redo require "+"sub undef unless until use wantarray while BEGIN END ";var PYTHON_KEYWORDS=FLOW_CONTROL_KEYWORDS+"and as assert class def del "+"elif except exec finally from global import in is lambda "+"nonlocal not or pass print raise try with yield "+"False True None ";var RUBY_KEYWORDS=FLOW_CONTROL_KEYWORDS+"alias and begin case class def"+" defined elsif end ensure false in module next nil not or redo rescue "+"retry self super then true undef unless until when yield BEGIN END ";var SH_KEYWORDS=FLOW_CONTROL_KEYWORDS+"case done elif esac eval fi "+"function in local set then until ";var ALL_KEYWORDS=(CPP_KEYWORDS+CSHARP_KEYWORDS+JSCRIPT_KEYWORDS+PERL_KEYWORDS+
PYTHON_KEYWORDS+RUBY_KEYWORDS+SH_KEYWORDS);var PR_STRING='str';var PR_KEYWORD='kwd';var PR_COMMENT='com';var PR_TYPE='typ';var PR_LITERAL='lit';var PR_PUNCTUATION='pun';var PR_PLAIN='pln';var PR_TAG='tag';var PR_DECLARATION='dec';var PR_SOURCE='src';var PR_ATTRIB_NAME='atn';var PR_ATTRIB_VALUE='atv';var PR_NOCODE='nocode';var REGEXP_PRECEDER_PATTERN=function(){var preceders=["!","!=","!==","#","%","%=","&","&&","&&=","&=","(","*","*=","+=",",","-=","->","/","/=",":","::",";","<","<<","<<=","<=","=","==","===",">",">=",">>",">>=",">>>",">>>=","?","@","[","^","^=","^^","^^=","{","|","|=","||","||=","~","break","case","continue","delete","do","else","finally","instanceof","return","throw","try","typeof"];var pattern='(?:^^|[+-]';for(var i=0;i<preceders.length;++i){pattern+='|'+preceders[i].replace(/([^=<>:&a-z])/g,'\\$1');}
pattern+=')\\s*';return pattern;}();var pr_amp=/&/g;var pr_lt=/</g;var pr_gt=/>/g;var pr_quot=/\"/g;function attribToHtml(str){return str.replace(pr_amp,'&').replace(pr_lt,'<').replace(pr_gt,'>').replace(pr_quot,'"');}
function textToHtml(str){return str.replace(pr_amp,'&').replace(pr_lt,'<').replace(pr_gt,'>');}
var pr_ltEnt=/</g;var pr_gtEnt=/>/g;var pr_aposEnt=/'/g;var pr_quotEnt=/"/g;var pr_ampEnt=/&/g;var pr_nbspEnt=/ /g;function htmlToText(html){var pos=html.indexOf('&');if(pos<0){return html;}
for(--pos;(pos=html.indexOf('&#',pos+1))>=0;){var end=html.indexOf(';',pos);if(end>=0){var num=html.substring(pos+3,end);var radix=10;if(num&&num.charAt(0)==='x'){num=num.substring(1);radix=16;}
var codePoint=parseInt(num,radix);if(!isNaN(codePoint)){html=(html.substring(0,pos)+String.fromCharCode(codePoint)+
html.substring(end+1));}}}
return html.replace(pr_ltEnt,'<').replace(pr_gtEnt,'>').replace(pr_aposEnt,"'").replace(pr_quotEnt,'"').replace(pr_nbspEnt,' ').replace(pr_ampEnt,'&');}
function isRawContent(node){return'XMP'===node.tagName;}
var newlineRe=/[\r\n]/g;function isPreformatted(node,content){if('PRE'===node.tagName){return true;}
if(!newlineRe.test(content)){return true;}
var whitespace='';if(node.currentStyle){whitespace=node.currentStyle.whiteSpace;}else if(window.getComputedStyle){whitespace=window.getComputedStyle(node,null).whiteSpace;}
return!whitespace||whitespace==='pre';}
function normalizedHtml(node,out){switch(node.nodeType){case 1:var name=node.tagName.toLowerCase();out.push('<',name);for(var i=0;i<node.attributes.length;++i){var attr=node.attributes[i];if(!attr.specified){continue;}
out.push(' ');normalizedHtml(attr,out);}
out.push('>');for(var child=node.firstChild;child;child=child.nextSibling){normalizedHtml(child,out);}
if(node.firstChild||!/^(?:br|link|img)$/.test(name)){out.push('<\/',name,'>');}
break;case 2:out.push(node.name.toLowerCase(),'="',attribToHtml(node.value),'"');break;case 3:case 4:out.push(textToHtml(node.nodeValue));break;}}
function combinePrefixPatterns(regexs){var capturedGroupIndex=0;var needToFoldCase=false;var ignoreCase=false;for(var i=0,n=regexs.length;i<n;++i){var regex=regexs[i];if(regex.ignoreCase){ignoreCase=true;}else if(/[a-z]/i.test(regex.source.replace(/\\u[0-9a-f]{4}|\\x[0-9a-f]{2}|\\[^ux]/gi,''))){needToFoldCase=true;ignoreCase=false;break;}}
function decodeEscape(charsetPart){if(charsetPart.charAt(0)!=='\\'){return charsetPart.charCodeAt(0);}
switch(charsetPart.charAt(1)){case'b':return 8;case't':return 9;case'n':return 0xa;case'v':return 0xb;case'f':return 0xc;case'r':return 0xd;case'u':case'x':return parseInt(charsetPart.substring(2),16)||charsetPart.charCodeAt(1);case'0':case'1':case'2':case'3':case'4':case'5':case'6':case'7':return parseInt(charsetPart.substring(1),8);default:return charsetPart.charCodeAt(1);}}
function encodeEscape(charCode){if(charCode<0x20){return(charCode<0x10?'\\x0':'\\x')+charCode.toString(16);}
var ch=String.fromCharCode(charCode);if(ch==='\\'||ch==='-'||ch==='['||ch===']'){ch='\\'+ch;}
return ch;}
function caseFoldCharset(charSet){var charsetParts=charSet.substring(1,charSet.length-1).match(new RegExp('\\\\u[0-9A-Fa-f]{4}'
+'|\\\\x[0-9A-Fa-f]{2}'
+'|\\\\[0-3][0-7]{0,2}'
+'|\\\\[0-7]{1,2}'
+'|\\\\[\\s\\S]'
+'|-'
+'|[^-\\\\]','g'));var groups=[];var ranges=[];var inverse=charsetParts[0]==='^';for(var i=inverse?1:0,n=charsetParts.length;i<n;++i){var p=charsetParts[i];switch(p){case'\\B':case'\\b':case'\\D':case'\\d':case'\\S':case'\\s':case'\\W':case'\\w':groups.push(p);continue;}
var start=decodeEscape(p);var end;if(i+2<n&&'-'===charsetParts[i+1]){end=decodeEscape(charsetParts[i+2]);i+=2;}else{end=start;}
ranges.push([start,end]);if(!(end<65||start>122)){if(!(end<65||start>90)){ranges.push([Math.max(65,start)|32,Math.min(end,90)|32]);}
if(!(end<97||start>122)){ranges.push([Math.max(97,start)&~32,Math.min(end,122)&~32]);}}}
ranges.sort(function(a,b){return(a[0]-b[0])||(b[1]-a[1]);});var consolidatedRanges=[];var lastRange=[NaN,NaN];for(var i=0;i<ranges.length;++i){var range=ranges[i];if(range[0]<=lastRange[1]+1){lastRange[1]=Math.max(lastRange[1],range[1]);}else{consolidatedRanges.push(lastRange=range);}}
var out=['['];if(inverse){out.push('^');}
out.push.apply(out,groups);for(var i=0;i<consolidatedRanges.length;++i){var range=consolidatedRanges[i];out.push(encodeEscape(range[0]));if(range[1]>range[0]){if(range[1]+1>range[0]){out.push('-');}
out.push(encodeEscape(range[1]));}}
out.push(']');return out.join('');}
function allowAnywhereFoldCaseAndRenumberGroups(regex){var parts=regex.source.match(new RegExp('(?:'
+'\\[(?:[^\\x5C\\x5D]|\\\\[\\s\\S])*\\]'
+'|\\\\u[A-Fa-f0-9]{4}'
+'|\\\\x[A-Fa-f0-9]{2}'
+'|\\\\[0-9]+'
+'|\\\\[^ux0-9]'
+'|\\(\\?[:!=]'
+'|[\\(\\)\\^]'
+'|[^\\x5B\\x5C\\(\\)\\^]+'
+')','g'));var n=parts.length;var capturedGroups=[];for(var i=0,groupIndex=0;i<n;++i){var p=parts[i];if(p==='('){++groupIndex;}else if('\\'===p.charAt(0)){var decimalValue=+p.substring(1);if(decimalValue&&decimalValue<=groupIndex){capturedGroups[decimalValue]=-1;}}}
for(var i=1;i<capturedGroups.length;++i){if(-1===capturedGroups[i]){capturedGroups[i]=++capturedGroupIndex;}}
for(var i=0,groupIndex=0;i<n;++i){var p=parts[i];if(p==='('){++groupIndex;if(capturedGroups[groupIndex]===undefined){parts[i]='(?:';}}else if('\\'===p.charAt(0)){var decimalValue=+p.substring(1);if(decimalValue&&decimalValue<=groupIndex){parts[i]='\\'+capturedGroups[groupIndex];}}}
for(var i=0,groupIndex=0;i<n;++i){if('^'===parts[i]&&'^'!==parts[i+1]){parts[i]='';}}
if(regex.ignoreCase&&needToFoldCase){for(var i=0;i<n;++i){var p=parts[i];var ch0=p.charAt(0);if(p.length>=2&&ch0==='['){parts[i]=caseFoldCharset(p);}else if(ch0!=='\\'){parts[i]=p.replace(/[a-zA-Z]/g,function(ch){var cc=ch.charCodeAt(0);return'['+String.fromCharCode(cc&~32,cc|32)+']';});}}}
return parts.join('');}
var rewritten=[];for(var i=0,n=regexs.length;i<n;++i){var regex=regexs[i];if(regex.global||regex.multiline){throw new Error(''+regex);}
rewritten.push('(?:'+allowAnywhereFoldCaseAndRenumberGroups(regex)+')');}
return new RegExp(rewritten.join('|'),ignoreCase?'gi':'g');}
var PR_innerHtmlWorks=null;function getInnerHtml(node){if(null===PR_innerHtmlWorks){var testNode=document.createElement('PRE');testNode.appendChild(document.createTextNode('<!DOCTYPE foo PUBLIC "foo bar">\n<foo />'));PR_innerHtmlWorks=!/</.test(testNode.innerHTML);}
if(PR_innerHtmlWorks){var content=node.innerHTML;if(isRawContent(node)){content=textToHtml(content);}else if(!isPreformatted(node,content)){content=content.replace(/(<br\s*\/?>)[\r\n]+/g,'$1').replace(/(?:[\r\n]+[ \t]*)+/g,' ');}
return content;}
var out=[];for(var child=node.firstChild;child;child=child.nextSibling){normalizedHtml(child,out);}
return out.join('');}
function makeTabExpander(tabWidth){var SPACES='                ';var charInLine=0;return function(plainText){var out=null;var pos=0;for(var i=0,n=plainText.length;i<n;++i){var ch=plainText.charAt(i);switch(ch){case'\t':if(!out){out=[];}
out.push(plainText.substring(pos,i));var nSpaces=tabWidth-(charInLine%tabWidth);charInLine+=nSpaces;for(;nSpaces>=0;nSpaces-=SPACES.length){out.push(SPACES.substring(0,nSpaces));}
pos=i+1;break;case'\n':charInLine=0;break;default:++charInLine;}}
if(!out){return plainText;}
out.push(plainText.substring(pos));return out.join('');};}
var pr_chunkPattern=new RegExp('[^<]+'
+'|<\!--[\\s\\S]*?--\>'
+'|<!\\[CDATA\\[[\\s\\S]*?\\]\\]>'
+'|<\/?[a-zA-Z](?:[^>\"\']|\'[^\']*\'|\"[^\"]*\")*>'
+'|<','g');var pr_commentPrefix=/^<\!--/;var pr_cdataPrefix=/^<!\[CDATA\[/;var pr_brPrefix=/^<br\b/i;var pr_tagNameRe=/^<(\/?)([a-zA-Z][a-zA-Z0-9]*)/;function extractTags(s){var matches=s.match(pr_chunkPattern);var sourceBuf=[];var sourceBufLen=0;var extractedTags=[];if(matches){for(var i=0,n=matches.length;i<n;++i){var match=matches[i];if(match.length>1&&match.charAt(0)==='<'){if(pr_commentPrefix.test(match)){continue;}
if(pr_cdataPrefix.test(match)){sourceBuf.push(match.substring(9,match.length-3));sourceBufLen+=match.length-12;}else if(pr_brPrefix.test(match)){sourceBuf.push('\n');++sourceBufLen;}else{if(match.indexOf(PR_NOCODE)>=0&&isNoCodeTag(match)){var name=match.match(pr_tagNameRe)[2];var depth=1;var j;end_tag_loop:for(j=i+1;j<n;++j){var name2=matches[j].match(pr_tagNameRe);if(name2&&name2[2]===name){if(name2[1]==='/'){if(--depth===0){break end_tag_loop;}}else{++depth;}}}
if(j<n){extractedTags.push(sourceBufLen,matches.slice(i,j+1).join(''));i=j;}else{extractedTags.push(sourceBufLen,match);}}else{extractedTags.push(sourceBufLen,match);}}}else{var literalText=htmlToText(match);sourceBuf.push(literalText);sourceBufLen+=literalText.length;}}}
return{source:sourceBuf.join(''),tags:extractedTags};}
function isNoCodeTag(tag){return!!tag.replace(/\s(\w+)\s*=\s*(?:\"([^\"]*)\"|'([^\']*)'|(\S+))/g,' $1="$2$3$4"').match(/[cC][lL][aA][sS][sS]=\"[^\"]*\bnocode\b/);}
function appendDecorations(basePos,sourceCode,langHandler,out){if(!sourceCode){return;}
var job={source:sourceCode,basePos:basePos};langHandler(job);out.push.apply(out,job.decorations);}
function createSimpleLexer(shortcutStylePatterns,fallthroughStylePatterns){var shortcuts={};var tokenizer;(function(){var allPatterns=shortcutStylePatterns.concat(fallthroughStylePatterns);var allRegexs=[];var regexKeys={};for(var i=0,n=allPatterns.length;i<n;++i){var patternParts=allPatterns[i];var shortcutChars=patternParts[3];if(shortcutChars){for(var c=shortcutChars.length;--c>=0;){shortcuts[shortcutChars.charAt(c)]=patternParts;}}
var regex=patternParts[1];var k=''+regex;if(!regexKeys.hasOwnProperty(k)){allRegexs.push(regex);regexKeys[k]=null;}}
allRegexs.push(/[\0-\uffff]/);tokenizer=combinePrefixPatterns(allRegexs);})();var nPatterns=fallthroughStylePatterns.length;var notWs=/\S/;var decorate=function(job){var sourceCode=job.source,basePos=job.basePos;var decorations=[basePos,PR_PLAIN];var pos=0;var tokens=sourceCode.match(tokenizer)||[];var styleCache={};for(var ti=0,nTokens=tokens.length;ti<nTokens;++ti){var token=tokens[ti];var style=styleCache[token];var match=void 0;var isEmbedded;if(typeof style==='string'){isEmbedded=false;}else{var patternParts=shortcuts[token.charAt(0)];if(patternParts){match=token.match(patternParts[1]);style=patternParts[0];}else{for(var i=0;i<nPatterns;++i){patternParts=fallthroughStylePatterns[i];match=token.match(patternParts[1]);if(match){style=patternParts[0];break;}}
if(!match){style=PR_PLAIN;}}
isEmbedded=style.length>=5&&'lang-'===style.substring(0,5);if(isEmbedded&&!(match&&typeof match[1]==='string')){isEmbedded=false;style=PR_SOURCE;}
if(!isEmbedded){styleCache[token]=style;}}
var tokenStart=pos;pos+=token.length;if(!isEmbedded){decorations.push(basePos+tokenStart,style);}else{var embeddedSource=match[1];var embeddedSourceStart=token.indexOf(embeddedSource);var embeddedSourceEnd=embeddedSourceStart+embeddedSource.length;if(match[2]){embeddedSourceEnd=token.length-match[2].length;embeddedSourceStart=embeddedSourceEnd-embeddedSource.length;}
var lang=style.substring(5);appendDecorations(basePos+tokenStart,token.substring(0,embeddedSourceStart),decorate,decorations);appendDecorations(basePos+tokenStart+embeddedSourceStart,embeddedSource,langHandlerForExtension(lang,embeddedSource),decorations);appendDecorations(basePos+tokenStart+embeddedSourceEnd,token.substring(embeddedSourceEnd),decorate,decorations);}}
job.decorations=decorations;};return decorate;}
function sourceDecorator(options){var shortcutStylePatterns=[],fallthroughStylePatterns=[];if(options['tripleQuotedStrings']){shortcutStylePatterns.push([PR_STRING,/^(?:\'\'\'(?:[^\'\\]|\\[\s\S]|\'{1,2}(?=[^\']))*(?:\'\'\'|$)|\"\"\"(?:[^\"\\]|\\[\s\S]|\"{1,2}(?=[^\"]))*(?:\"\"\"|$)|\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$))/,null,'\'"']);}else if(options['multiLineStrings']){shortcutStylePatterns.push([PR_STRING,/^(?:\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$)|\`(?:[^\\\`]|\\[\s\S])*(?:\`|$))/,null,'\'"`']);}else{shortcutStylePatterns.push([PR_STRING,/^(?:\'(?:[^\\\'\r\n]|\\.)*(?:\'|$)|\"(?:[^\\\"\r\n]|\\.)*(?:\"|$))/,null,'"\'']);}
if(options['verbatimStrings']){fallthroughStylePatterns.push([PR_STRING,/^@\"(?:[^\"]|\"\")*(?:\"|$)/,null]);}
if(options['hashComments']){if(options['cStyleComments']){shortcutStylePatterns.push([PR_COMMENT,/^#(?:(?:define|elif|else|endif|error|ifdef|include|ifndef|line|pragma|undef|warning)\b|[^\r\n]*)/,null,'#']);fallthroughStylePatterns.push([PR_STRING,/^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h|[a-z]\w*)>/,null]);}else{shortcutStylePatterns.push([PR_COMMENT,/^#[^\r\n]*/,null,'#']);}}
if(options['cStyleComments']){fallthroughStylePatterns.push([PR_COMMENT,/^\/\/[^\r\n]*/,null]);fallthroughStylePatterns.push([PR_COMMENT,/^\/\*[\s\S]*?(?:\*\/|$)/,null]);}
if(options['regexLiterals']){var REGEX_LITERAL=('/(?=[^/*])'
+'(?:[^/\\x5B\\x5C]'
+'|\\x5C[\\s\\S]'
+'|\\x5B(?:[^\\x5C\\x5D]|\\x5C[\\s\\S])*(?:\\x5D|$))+'
+'/');fallthroughStylePatterns.push(['lang-regex',new RegExp('^'+REGEXP_PRECEDER_PATTERN+'('+REGEX_LITERAL+')')]);}
var keywords=options['keywords'].replace(/^\s+|\s+$/g,'');if(keywords.length){fallthroughStylePatterns.push([PR_KEYWORD,new RegExp('^(?:'+keywords.replace(/\s+/g,'|')+')\\b'),null]);}
shortcutStylePatterns.push([PR_PLAIN,/^\s+/,null,' \r\n\t\xA0']);fallthroughStylePatterns.push([PR_LITERAL,/^@[a-z_$][a-z_$@0-9]*/i,null],[PR_TYPE,/^@?[A-Z]+[a-z][A-Za-z_$@0-9]*/,null],[PR_PLAIN,/^[a-z_$][a-z_$@0-9]*/i,null],[PR_LITERAL,new RegExp('^(?:'
+'0x[a-f0-9]+'
+'|(?:\\d(?:_\\d+)*\\d*(?:\\.\\d*)?|\\.\\d\\+)'
+'(?:e[+\\-]?\\d+)?'
+')'
+'[a-z]*','i'),null,'0123456789'],[PR_PUNCTUATION,/^.[^\s\w\.$@\'\"\`\/\#]*/,null]);return createSimpleLexer(shortcutStylePatterns,fallthroughStylePatterns);}
var decorateSource=sourceDecorator({'keywords':ALL_KEYWORDS,'hashComments':true,'cStyleComments':true,'multiLineStrings':true,'regexLiterals':true});function recombineTagsAndDecorations(job){var sourceText=job.source;var extractedTags=job.extractedTags;var decorations=job.decorations;var html=[];var outputIdx=0;var openDecoration=null;var currentDecoration=null;var tagPos=0;var decPos=0;var tabExpander=makeTabExpander(window['PR_TAB_WIDTH']);var adjacentSpaceRe=/([\r\n ]) /g;var startOrSpaceRe=/(^| ) /gm;var newlineRe=/\r\n?|\n/g;var trailingSpaceRe=/[ \r\n]$/;var lastWasSpace=true;var isIE678=window['_pr_isIE6']();var lineBreakHtml=(isIE678?(job.sourceNode.tagName==='PRE'?(isIE678===6?' \r\n':' \r'):' <br />'):'<br />');function emitTextUpTo(sourceIdx){if(sourceIdx>outputIdx){if(openDecoration&&openDecoration!==currentDecoration){html.push('</span>');openDecoration=null;}
if(!openDecoration&&currentDecoration){openDecoration=currentDecoration;html.push('<span class="',openDecoration,'">');}
var htmlChunk=textToHtml(tabExpander(sourceText.substring(outputIdx,sourceIdx))).replace(lastWasSpace?startOrSpaceRe:adjacentSpaceRe,'$1 ');lastWasSpace=trailingSpaceRe.test(htmlChunk);html.push(htmlChunk.replace(newlineRe,lineBreakHtml));outputIdx=sourceIdx;}}
while(true){var outputTag;if(tagPos<extractedTags.length){if(decPos<decorations.length){outputTag=extractedTags[tagPos]<=decorations[decPos];}else{outputTag=true;}}else{outputTag=false;}
if(outputTag){emitTextUpTo(extractedTags[tagPos]);if(openDecoration){html.push('</span>');openDecoration=null;}
html.push(extractedTags[tagPos+1]);tagPos+=2;}else if(decPos<decorations.length){emitTextUpTo(decorations[decPos]);currentDecoration=decorations[decPos+1];decPos+=2;}else{break;}}
emitTextUpTo(sourceText.length);if(openDecoration){html.push('</span>');}
job.prettyPrintedHtml=html.join('');}
var langHandlerRegistry={};function registerLangHandler(handler,fileExtensions){for(var i=fileExtensions.length;--i>=0;){var ext=fileExtensions[i];if(!langHandlerRegistry.hasOwnProperty(ext)){langHandlerRegistry[ext]=handler;}else if('console'in window){console.warn('cannot override language handler %s',ext);}}}
function langHandlerForExtension(extension,source){if(!(extension&&langHandlerRegistry.hasOwnProperty(extension))){extension=/^\s*</.test(source)?'default-markup':'default-code';}
return langHandlerRegistry[extension];}
registerLangHandler(decorateSource,['default-code']);registerLangHandler(createSimpleLexer([],[[PR_PLAIN,/^[^<?]+/],[PR_DECLARATION,/^<!\w[^>]*(?:>|$)/],[PR_COMMENT,/^<\!--[\s\S]*?(?:-\->|$)/],['lang-',/^<\?([\s\S]+?)(?:\?>|$)/],['lang-',/^<%([\s\S]+?)(?:%>|$)/],[PR_PUNCTUATION,/^(?:<[%?]|[%?]>)/],['lang-',/^<xmp\b[^>]*>([\s\S]+?)<\/xmp\b[^>]*>/i],['lang-js',/^<script\b[^>]*>([\s\S]*?)(<\/script\b[^>]*>)/i],['lang-css',/^<style\b[^>]*>([\s\S]*?)(<\/style\b[^>]*>)/i],['lang-in.tag',/^(<\/?[a-z][^<>]*>)/i]]),['default-markup','htm','html','mxml','xhtml','xml','xsl']);registerLangHandler(createSimpleLexer([[PR_PLAIN,/^[\s]+/,null,' \t\r\n'],[PR_ATTRIB_VALUE,/^(?:\"[^\"]*\"?|\'[^\']*\'?)/,null,'\"\'']],[[PR_TAG,/^^<\/?[a-z](?:[\w.:-]*\w)?|\/?>$/i],[PR_ATTRIB_NAME,/^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],['lang-uq.val',/^=\s*([^>\'\"\s]*(?:[^>\'\"\s\/]|\/(?=\s)))/],[PR_PUNCTUATION,/^[=<>\/]+/],['lang-js',/^on\w+\s*=\s*\"([^\"]+)\"/i],['lang-js',/^on\w+\s*=\s*\'([^\']+)\'/i],['lang-js',/^on\w+\s*=\s*([^\"\'>\s]+)/i],['lang-css',/^style\s*=\s*\"([^\"]+)\"/i],['lang-css',/^style\s*=\s*\'([^\']+)\'/i],['lang-css',/^style\s*=\s*([^\"\'>\s]+)/i]]),['in.tag']);registerLangHandler(createSimpleLexer([],[[PR_ATTRIB_VALUE,/^[\s\S]+/]]),['uq.val']);registerLangHandler(sourceDecorator({'keywords':CPP_KEYWORDS,'hashComments':true,'cStyleComments':true}),['c','cc','cpp','cxx','cyc','m']);registerLangHandler(sourceDecorator({'keywords':'null true false'}),['json']);registerLangHandler(sourceDecorator({'keywords':CSHARP_KEYWORDS,'hashComments':true,'cStyleComments':true,'verbatimStrings':true}),['cs']);registerLangHandler(sourceDecorator({'keywords':JAVA_KEYWORDS,'cStyleComments':true}),['java']);registerLangHandler(sourceDecorator({'keywords':SH_KEYWORDS,'hashComments':true,'multiLineStrings':true}),['bsh','csh','sh']);registerLangHandler(sourceDecorator({'keywords':PYTHON_KEYWORDS,'hashComments':true,'multiLineStrings':true,'tripleQuotedStrings':true}),['cv','py']);registerLangHandler(sourceDecorator({'keywords':PERL_KEYWORDS,'hashComments':true,'multiLineStrings':true,'regexLiterals':true}),['perl','pl','pm']);registerLangHandler(sourceDecorator({'keywords':RUBY_KEYWORDS,'hashComments':true,'multiLineStrings':true,'regexLiterals':true}),['rb']);registerLangHandler(sourceDecorator({'keywords':JSCRIPT_KEYWORDS,'cStyleComments':true,'regexLiterals':true}),['js']);registerLangHandler(createSimpleLexer([],[[PR_STRING,/^[\s\S]+/]]),['regex']);function applyDecorator(job){var sourceCodeHtml=job.sourceCodeHtml;var opt_langExtension=job.langExtension;job.prettyPrintedHtml=sourceCodeHtml;try{var sourceAndExtractedTags=extractTags(sourceCodeHtml);var source=sourceAndExtractedTags.source;job.source=source;job.basePos=0;job.extractedTags=sourceAndExtractedTags.tags;langHandlerForExtension(opt_langExtension,source)(job);recombineTagsAndDecorations(job);}catch(e){if('console'in window){console.log(e);console.trace();}}}
function prettyPrintOne(sourceCodeHtml,opt_langExtension){var job={sourceCodeHtml:sourceCodeHtml,langExtension:opt_langExtension};applyDecorator(job);return job.prettyPrintedHtml;}
function prettyPrint(opt_whenDone){var codeSegments=[document.getElementsByTagName('pre'),document.getElementsByTagName('code'),document.getElementsByTagName('xmp')];var elements=[];for(var i=0;i<codeSegments.length;++i){for(var j=0,n=codeSegments[i].length;j<n;++j){elements.push(codeSegments[i][j]);}}
codeSegments=null;var clock=Date;if(!clock['now']){clock={'now':function(){return(new Date).getTime();}};}
var k=0;var prettyPrintingJob;function doWork(){var endTime=(window['PR_SHOULD_USE_CONTINUATION']?clock.now()+250:Infinity);for(;k<elements.length&&clock.now()<endTime;k++){var cs=elements[k];if(cs.className&&cs.className.indexOf('prettyprint')>=0){var langExtension=cs.className.match(/\blang-(\w+)\b/);if(langExtension){langExtension=langExtension[1];}
var nested=false;for(var p=cs.parentNode;p;p=p.parentNode){if((p.tagName==='pre'||p.tagName==='code'||p.tagName==='xmp')&&p.className&&p.className.indexOf('prettyprint')>=0){nested=true;break;}}
if(!nested){var content=getInnerHtml(cs);content=content.replace(/(?:\r\n?|\n)$/,'');prettyPrintingJob={sourceCodeHtml:content,langExtension:langExtension,sourceNode:cs};applyDecorator(prettyPrintingJob);replaceWithPrettyPrintedHtml();}}}
if(k<elements.length){setTimeout(doWork,250);}else if(opt_whenDone){opt_whenDone();}}
function replaceWithPrettyPrintedHtml(){var newContent=prettyPrintingJob.prettyPrintedHtml;if(!newContent){return;}
var cs=prettyPrintingJob.sourceNode;if(!isRawContent(cs)){cs.innerHTML=newContent;}else{var pre=document.createElement('PRE');for(var i=0;i<cs.attributes.length;++i){var a=cs.attributes[i];if(a.specified){var aname=a.name.toLowerCase();if(aname==='class'){pre.className=a.value;}else{pre.setAttribute(a.name,a.value);}}}
pre.innerHTML=newContent;cs.parentNode.replaceChild(pre,cs);cs=pre;}}
doWork();}
window['PR_normalizedHtml']=normalizedHtml;window['prettyPrintOne']=prettyPrintOne;window['prettyPrint']=prettyPrint;window['PR']={'combinePrefixPatterns':combinePrefixPatterns,'createSimpleLexer':createSimpleLexer,'registerLangHandler':registerLangHandler,'sourceDecorator':sourceDecorator,'PR_ATTRIB_NAME':PR_ATTRIB_NAME,'PR_ATTRIB_VALUE':PR_ATTRIB_VALUE,'PR_COMMENT':PR_COMMENT,'PR_DECLARATION':PR_DECLARATION,'PR_KEYWORD':PR_KEYWORD,'PR_LITERAL':PR_LITERAL,'PR_NOCODE':PR_NOCODE,'PR_PLAIN':PR_PLAIN,'PR_PUNCTUATION':PR_PUNCTUATION,'PR_SOURCE':PR_SOURCE,'PR_STRING':PR_STRING,'PR_TAG':PR_TAG,'PR_TYPE':PR_TYPE};})();