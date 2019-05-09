var app = getApp()
Page({
  data: {
    navs1:
    [{ icon: "/img/7.jpg", name: "个人信息", url: '/pages/user/user' },
    { icon: "/img/8.jpg", name: "  举报" },
    { icon: "/img/9.jpg", name: "帮助" },
    ],
    navs2:
    [{ icon: "/img/10.jpg", name: "学习记录", url: '/pages/logs/logs' },
    { icon: "/img/11.jpg", name: "信誉积分" },
    { icon: "/img/12.jpg", name: "反馈" }],
    openid: '',

    userInfo: {},
    userlist: {},
    hasUserInfo: false,
    canIUse: wx.canIUse('button.open-type.getUserInfo')

  },

  xinxi: function () {
    wx.navigateTo({
      url: '/pages/user/user',
    })

  },
  xuexi: function () {
    wx.navigateTo({
      url: '/pages/logs/logs',
    })

  },
  onLoad: function () {
    
    var that = this;
    wx.login({
      success: function (res) {

        wx.request({
          url: 'https://118.25.4.219/tsg/index.php/Home/Wechat/openid/code/' + res.code,
          header: {
            'content-type': 'application/json'
          },
          method: 'GET',
          success: function (rs) {
            console.log(rs.data)
            that.setData({
              openid: rs.data
              
            })
            wx.request({
              url: 'https://118.25.4.219/tsg/index.php/Home/Wechat/user/openid/' + rs.data,
              header: {
                'content-type': 'application/json'
              },
              data: {},
              method: 'GET',
              success: function (e) {
                console.log(e.data)
                that.setData({
                  userlist: e.data
                })
              }

            })
          },

        })
      }
    })
    
  },


  bindGetUserInfo: function (e) {
    var that = this
    that.setData({
      userInfo: e.detail.userInfo
    })
    
  }



})  