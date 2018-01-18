import config from "../../utils/config"
import util from "../../utils/util"

//index.js
//获取应用实例
var app = getApp()

Page({
  data: {
    private_to_name: "群暗恋",
    private_to_url: "",
    //参与了的暗恋群的列表
    likes: [],
    userInfo: {},
    hasUserInfo: false,
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    requestTime:null,
    config:{},
    testinfo:"测试信息 :",
    testinfoTmp:"",
    showdebug:false
  },
  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  onLoad: function (opt) {

        if (app.globalData.userInfo) {
          this.setData({
            userInfo: app.globalData.userInfo,
            hasUserInfo: true
          })
        } else if (this.data.canIUse){
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



    if(this.data.showdebug){
      setInterval(()=>{
        var that = this
        if(that.data.testinfoTmp != app.globalData.testinfo){
          that.data.testinfoTmp = app.globalData.testinfo;
          var testinfo = that.data.testinfo+"\n"+app.globalData.testinfo
          this.setData({
            testinfo:testinfo
          })
        }
      },1500)
    }

    wx.showShareMenu({
      withShareTicket: true
    })





  },

 onShow: function () {
   console.log("显示 了.")
       this.setData({
         requestTime:setInterval(()=>{
           //初次加载
           console.log("首页请求数据",app.globalData.uid)
           if(app.globalData.uid){
               var config = {
                 config:app.globalData.config
               }
               console.log(config)
               this.setData(config)
             util.getLikes(app.globalData.uid,(likes) => {
               console.log('成功取得数据并清除定时.',likes)
               clearInterval(this.data.requestTime);
               this.setData({
                 likes : likes
               });
             })
           }
         },300)
       })
 },
  onReady:function(){

  },
    /**
     * 生命周期函数--监听页面显示
     */
  getUserInfo: function(e) {
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  onShareAppMessage: function () {
    var that = this;
    return {
      title: '说不定你喜欢的人，也喜欢你呢？相互暗恋会收到匹配私信。',
      path: '/pages/index/index',
      imageUrl:"../../imgs/icon/search.png",
      success: function ( res ) {
        util.share(res,(re)=>{
          console.log(re)
          that.setData({
            likes : re.data
          })
        },true)
      },
      fail: function (res) {
        console.log(res)
      }
    }
  },
  //跳转到配对详情
  toLikeDetail:function(e){
    console.log(e.currentTarget.dataset.id)
    wx.navigateTo({
      url: "../likes/likes?id" + e.currentTarget.dataset.id
    })
    //wx.redirectTo()
  }
})
