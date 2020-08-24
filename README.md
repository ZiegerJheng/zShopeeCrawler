# zShopeeCrawler

A simple Shopee Crawler, will get product title and price. Also translate product title from Traditional Chinese to Simplified Chinese.

## Requirements

- node 7.6.0 or higher
- Puppeteer Node library

Required by Browsershot package to execute Javascript, please reference [here](https://github.com/spatie/crawler#executing-javascript)

## Usage

Running on bash command line:
``` bash
php run.php
```

## Example Output

```
现货 TOMY 口袋妖怪 宠物小精灵神奇宝贝精灵球皮卡丘小火龙杰尼龟 8cm触碰可翻转 爆炸精灵球整玩具 时尚最夯小物
$198.00 - $980.00
---
‘现货’ 神奇宝贝 扭蛋 伊布皮卡丘 伊布 皮卡丘 呆河马 可达鸭 呆呆兽 变装
$237.00 - $837.00
---
空运 TOMY口袋妖怪小火龙杰尼龟妙蛙种子雷丘皮丘皮卡丘手办
$99.00 - $299.00
---
W1111 宝可梦 食玩 7-11 限定 磁铁 皮卡丘杰尼龟妙蛙种子泪眼蜥炎兔儿胖丁暴鲤龙敲音猴 不含软糖 现货
$50.00 - $100.00
---
佳佳玩具 ----- 日本进口 神奇宝贝 宝可梦 Pokemon 手表 碼手表 卡通手表 【05391197】
$249.00
---
现货TOMY 神奇宝贝宝可梦Pokemon Go胡帕z神固拉多白龙黑龙X黑酋雷姆裂空座盖欧卡MEGA海皇牙固拉多模型手办
$350.00 - $1680.00
---
宝可梦 全新公仔 只拆开 耿鬼 谜拟Q 呆呆兽 可达鸭 伊布 鲤鱼王 波加曼 皮卡丘 妙蛙种子 太阳伊布 杰尼龟 小火龙
$20.00 - $40.00
---
§小俏妞部屋§ [现货/单款区] 日版POLYGO 千值练 精灵宝可梦 皮卡丘耿鬼小火龙杰尼龟妙蛙种子呆呆兽 盒玩
$250.00
---
【DS变装皮卡丘 黄昏之鬃、拂晓之翼、奈克洛兹玛、胡帕、波尔凯尼恩】立体图鉴GK◆精灵宝可梦/神奇宝贝★湖畔蓝鳄☆
$220.00 - $999.00
---
一番赏 伊布 宝可梦 EIEVUI&CRYSTAL DROPS G赏F赏
$200.00 - $220.00
---
```

## References

- https://github.com/spatie/crawler
- https://symfony.com/doc/current/components/dom_crawler.html