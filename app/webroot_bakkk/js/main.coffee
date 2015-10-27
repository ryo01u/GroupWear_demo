document.addEventListener "DOMContentLoaded", ->
  event_fn = new radio_event_api()
  # event_fn.int("http://podcasts.tfm.co.jp/mv_timeshift/kiyokiba/mvts_kiyokiba_141006.m4a")
  event_fn.int 'http://pon-dev.gsj.bz/subtitles/wav/JET_STREAM2014CEATEC.wav'
e_t = [[1,30],[3,15],[5,0],[6,45],[7,30],[9,15]]

class window.radio_event_api extends _main
  context = null
  dogBarkingBuffer = null

  int:(url)->
    that = @
    try
      window.AudioContext = window.AudioContext or window.webkitAudioContext
      context = new AudioContext()
    catch e
      alert "Web Audio API is not supported in this browser"
    @loadDogSound(url)
    @addEvent play_btn2 ,'click', ->
      that.playSound(dogBarkingBuffer)
  loadDogSound:(url) ->
    request = new XMLHttpRequest()
    request.open "GET", url, true
    request.responseType = "arraybuffer"
    request.onload = ->
      context.decodeAudioData request.response, ((buffer) ->
        return
      ), onError
      return

    request.send()
    return

  playSound = (buffer) ->
    source = context.createBufferSource() # creates a sound source
    source.buffer = buffer # tell the source which sound to play
    source.connect context.destination # connect the source to the context's destination (the speakers)
    source.start 0 # play the source now
    return



class window.radio_event extends _main
  audio = null
  duration = null
  play_btn = null
  bar_w = 0
  e_button = null
  context = null
  knob = null
  et = []

  int:->
    # audio = @i 'v01'
    that = @
    audio = new Audio("http://podcasts.tfm.co.jp/mv_timeshift/kiyokiba/mvts_kiyokiba_141006.m4a");
    audio.load()
    duration = 11*60 +24
    play_btn = @i 'play_btn'
    bar_w = @i('bar').offsetWidth
    e_button = @sa('#slid_bar ul li')
    knob = @i('knob')
    for val,i in e_t
      et[i] = val[0]*60 + val[1]
      # console.log et[i]
    context = new webkitAudioContext()
    @event_t(e_t)
    @addEvent play_btn ,'click', ->
      that.play_fn()
    @timer()
    for val,i in e_button
      that.set_event(i)
  set_event:(i)->
    # console.log i
    @addEvent e_button[i] ,'click', ->
      audio.currentTime = et[i]
      audio.play()
      # console.log i
    # e_button[i].addEvent play_btn ,'click', ->
      # console.log i
    # console.log b
    # that = @
    # left_px = []
    

    # for val,i in b
    #   j = 0

    #   # left_px[i] = (et[i]/duration)*bar_w
    #   # l = left_px[i] + 'px'

    #   val.addEventListener 'click', ->
    #     console.log --j
    #     that.play_event(i)
        # audio.currentTime = et[i]

  play_event:(i)->
    console.log i



  timer:->
    setInterval ->
      # console.log audio.currentTime
      knob.style.left = (audio.currentTime/duration)*bar_w+'px'
    ,200

  play_fn:->
    # duration = audio.duration
    # console.log duration
    audio.play()


  event_t:(t)->
    # duration = audio.duration
    # console.log duration
    tt = []
    for val,i in t
      # console.log i + ':' + val
      tt[i] = val[0]*60 + val[1]
    for val,i in e_button
      # console.log e_button[i]
      e_button[i].style.left = (tt[i]/duration)*bar_w+'px'
  loadDogSound:(url)->





class ClassName extends _main
  # Static variables
  @staticVar = 0
   
  # fields
  _fieldVar_1 = false
  _fieldVar_2 = ''
  _fieldVar_3 = null
   
  # constructor
  constructor: (args)->
    _fieldVar_1 = true
    # _fieldVar_2 = args.foo
    # _fieldVar_3 = args.bar
    # do something...
   
  # private methods
  privateFunc = (value)->
    if value
      msg = "Hello, #{value}!"
    else
      msg = "Goodbye, #{value}"
    msg
   
  # public methods
  publicFunc: (target)->
    privateFunc.call @, target
 
# myclass = new ClassName()
# # console.log myclass.s '#play_btn'

# main = new _main()

# document.addEventListener "DOMContentLoaded", ->
#   audio = main.i 'v01'
#   play_btn = main.s '#play_btn'
#   # console.log play_btn.innerHTML
#   play_fn = ->
#     # console.log play_btn.innerHTML
#     audio.play()
#     return
#   main.addEvent play_btn ,'click', ->
#     play_fn()
#   return

# radio_play = do () ->
#   audio = main.i 'v01'
#   play_btn = main.s '#play_btn'
#   global =
#     int:->


#   return global
#   return