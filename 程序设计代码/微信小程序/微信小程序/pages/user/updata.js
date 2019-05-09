var app = getApp()
var maxTime = 60
var currentTime = maxTime
var interval = null
const API_URL = 'https://118.25.4.219/tsg/index.php/Home/Wechat/';
Page({
  data: {
    userInfo: {}, 
    openid: 0
  },


  formBindsubmit: function (e) {
    var that = this;
    var formData = e.detail.value;
    var openid = that.data.openid;
      
        wx.request({
          url: API_URL + 'userupdata' + '/openid/' + openid,
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
            
              wx.switchTab({
                url: '../application/index',
              })
           
          }
        })
      
    
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