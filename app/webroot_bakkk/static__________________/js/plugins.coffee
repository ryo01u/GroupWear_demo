(->
  method = undefined
  noop = ->
  methods = [
    "assert"
    "clear"
    "count"
    "debug"
    "dir"
    "dirxml"
    "error"
    "exception"
    "group"
    "groupCollapsed"
    "groupEnd"
    "info"
    "log"
    "markTimeline"
    "profile"
    "profileEnd"
    "table"
    "time"
    "timeEnd"
    "timeStamp"
    "trace"
    "warn"
  ]
  length = methods.length
  console = (window.console = window.console or {})
  while length--
    method = methods[length]
    
    # Only stub undefined methods.
    console[method] = noop  unless console[method]
  return
)()

class _main 
  addEvent : (element, event, fn) ->
    if element.addEventListener
      element.addEventListener event, fn, false
    else element.attachEvent "on" + event, fn  if element.attachEvent
    return
  s:(selector)->
    document.querySelector(selector)
  sa:(selector)->
    document.querySelectorAll(selector);
  t:(tagname)->
    document.getElementsByTagName(tagname)
  c:(cl)->
    document.getElementsByClassName(cl)
  i:(idname)->
    document.getElementById(idname)
  addClass:(el,className)->
    if (el.classList)
      el.classList.add(className);
    else
      el.className += ' ' + className;
  removeClass:(el,className)->
    if (el.classList)
      el.classList.remove(className);
    else
      el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  fadeIn: (el,dur) ->
    el.style.opacity = 0
    dur = 400 if !dur
    last = +new Date()
    tick = ->
      el.style.display = ''
      el.style.opacity = +el.style.opacity + (new Date() - last) / dur
      last = +new Date()
      (window.requestAnimationFrame and requestAnimationFrame(tick)) or setTimeout(tick, 16)  if +el.style.opacity < 1
      return
    tick()
    return
  fadeOut: (el,dur) ->
    el.style.opacity = 0
    dur = 400 if !dur
    last = +new Date()
    el.style.opacity = 1
    tick = ->
      el.style.display = ''
      # console.log el.style.opacity
      el.style.opacity = + el.style.opacity - (new Date() - last) / dur
      last = +new Date()
      if el.style.opacity > 0
        (window.requestAnimationFrame and requestAnimationFrame(tick)) or setTimeout(tick, 16) 
      else
        el.style.display = 'none'
      return
    tick()
    return
  ajax:(url,xml,fn_suc,fn_err)->
    request = new XMLHttpRequest()
    request.open "GET", url, true
    request.onload = ->
      if request.status >= 200 and request.status < 400
        if  !(xml == "text")
          resp = request.responseXML
        else
          resp = request.responseText
        # console.log resp
        fn_suc(resp)
      else
        fn_err(resp) 
    request.onerror = ->
      fn_err(resp) 
      return
    request.send()
    return
    # request.send()
