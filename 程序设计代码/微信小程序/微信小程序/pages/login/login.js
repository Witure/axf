var app = getApp()
var maxTime = 60
var currentTime = maxTime 
var interval = null
const API_URL = 'https://118.25.4.219/tsg/index.php/Home/Wechat/';
Page({
  data: {
    userInfo: {},
    btnName: '获取验证码',
    disabled: false,
    mobile: '1234567890',
    msCodes: '0',
    openid: 0
  },

  mobileInputEvent: function (ev) {
    console.log(ev.detail.value)
    var mobile = ev.detail.value;
    if (mobile.length == 11){
      this.setData({
        mobile: ev.detail.value
      })
    }
  },

  reSendPhoneNum: function (e) {
    var that = this;
    var tel = that.data.mobile;
    if (tel == '1234567890') {
      wx.showToast({
        title: '请填手机号',
        icon: 'loading',
        duration: 1000
      })
    } else {
        currentTime = maxTime;
        interval = setInterval(function () {
          currentTime--
          that.setData({
            time: '(' + currentTime + 's)',
            disabled: true,
            btnName: '请稍后'
          })
          if (currentTime <= 0) {
            currentTime = -1
            clearInterval(interval)
            that.setData({
              time: '',
              disabled: false,
              btnName: '重新获取'
            })
          }
        }, 1000)
        setTimeout(function () {
          wx.request({
            url: API_URL + 'msCode/tel/' + tel,
            data: '',
            header: {
              'Content-Type': 'application/json'
            },
            success: function (e) {
              console.log('验证码是：',e.data)
              that.setData({
                msCodes: e.data
              })
            }
          })
        }, 1000)
        wx.showToast({
          title: '发送成功',
          icon: 'loading',
          duration: 700
        })
    }
  },

  formBindsubmit: function (e) {
    var that = this;
    var formData = e.detail.value;
    var openid = that.data.openid;
    var msCode = that.data.msCodes; 
    var telCode = e.detail.value.telCode;
    var mobile = that.data.mobile;
    if (mobile == '1234567890'){
      wx.showToast({
        title: '请填手机号',
        icon: 'loading',
        duration: 1000
      })
    }else{
      if (msCode == telCode) {
        wx.request({
          url: API_URL + 'userChick' + '/openid/' + openid,
          data: formData,
          header: {
            'Content-Type': 'application/json'
          },
          success: function (e) {
            console.log(e)
            wx.showToast({
              title: '验证通过',
              icon: 'loading',
              duration: 1000
            })
            setTimeout(function () {
              wx.switchTab({
                url: '../application/index',
              })
            }, 1200)
          }
        })
      } else {
        wx.showToast({
          title: '验证码错误',
          icon: 'loading',
          duration: 1000
        })
      }
    }
  },

  onLoad: function (options) {
    if (app.globalData.userInfo) {
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
    } else if (this.data.canIUse) {
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        this.setData({
          userInfo: res.userInfo,
          hasUserInfo: true
        })
      }
    } else {
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          app.globalData.userInfo = res.userInfo
          this.setData({
            userInfo: res.userInfo,
            hasUserInfo: true
          })
        }
      })
    }


    var that = this
    wx.login({
      success: function (loginCode) {
        wx.request({
          url: API_URL + '/openid/code/' + loginCode.code,
          header: {
            'content-type': 'application/json'
          },
          success: function (res) {
            console.log(res.data)
            that.setData({
              openid: res.data
            })
          }
        })
      }
    })

   
  }
})