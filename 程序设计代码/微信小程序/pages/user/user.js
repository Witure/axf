//获取应用实例
var app = getApp()
Page({
  data: {
    hidden:true ,
    showModalStatus: false,
    motto: '',
    userInfo: {},
    userlist: {},
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    display: true,
    openid:'',
    length:{}
  },
  //事件处理函数  
  bindViewTap: function () {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  onLoad: function () {

    

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
  

      var that = this;
      wx.login({
        success: function (res) {

          wx.request({
            url: 'https://qtmami.com/tsg/index.php/Home/Wechat/openid/code/' + res.code,
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
                url: 'https://qtmami.com/tsg/index.php/Home/Wechat/user/openid/' + rs.data,
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
                  if(e.data.status == '2'){
                    that.setData({
                      hidden: false
                    })
                  }else{
                    that.setData({
                      hidden: true
                    })
                  }
                }

              })
            },

          })
        }
      })

   
  },
  getUserInfo: function (e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  btn_up: function(){
    wx.navigateTo({
      url: '/pages/user/updata'
    })
  },
  exit: function(){
      var that = this
      var openid = this.data.openid;
      console.log(openid)
      wx.request({
        url: 'https://qtmami.com/tsg/index.php/Home/Wechat/exit/openid/' + openid,
        header: {
          'content-type': 'application/json'
        },
        data: {},
        method: 'GET',
        success: function (e) {
          console.log(e.data)
          if(e.data == 'error'){
            wx.showToast({
              title: '请到馆学习！',
              icon: 'loading',
              duration: 2000
            })
          }else{
            that.setData({
              length:e.data,
              showModalStatus: true
            })
            that.onLoad();
          }
         
        }

      })
  },
  powerDrawer: function (e) {
    var currentStatu = e.currentTarget.dataset.statu;
    this.util(currentStatu)
  },
  util: function (currentStatu) {
    /* 动画部分 */
    // 第1步：创建动画实例   
    var animation = wx.createAnimation({
      duration: 200,  //动画时长  
      timingFunction: "linear", //线性  
      delay: 0  //0则不延迟  
    });

    // 第2步：这个动画实例赋给当前的动画实例  
    this.animation = animation;

    // 第3步：执行第一组动画  
    animation.opacity(0).rotateX(-100).step();

    // 第4步：导出动画对象赋给数据对象储存  
    this.setData({
      animationData: animation.export()
    })

    // 第5步：设置定时器到指定时候后，执行第二组动画  
    setTimeout(function () {
      // 执行第二组动画  
      animation.opacity(1).rotateX(0).step();
      // 给数据对象储存的第一组动画，更替为执行完第二组动画的动画对象  
      this.setData({
        animationData: animation
      })

      //关闭  
      if (currentStatu == "close") {
        this.setData(
          {
            showModalStatus: false
          }
        );
      }
    }.bind(this), 200)

    // 显示  
    if (currentStatu == "open") {
      this.setData(
        {
          showModalStatus: true
        }
      );
    }
  },
  onPullDownRefresh: function () {
    this.onLoad();
    wx.stopPullDownRefresh({

    })

  },
})  