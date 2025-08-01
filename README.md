# 🎲 SEO应用方向 随机 HTML 模板混淆器 

> 一个极简 PHP 工具，可在现有 `.html` 模板中**随机插入无感知的 HTML 标签**，用于**模板指纹追踪、反爬或 A/B 测试**。
> 程序很简单， 但是思路值得参考 ， 这个思路对SEO批量程序还是很有意义的

---

## ✨ 功能说明

1. 扫描 `./muban` 目录下的所有 `.html` 模板。  
2. 随机选取一个模板文件。  
3. 找到所有 `</div>` 与 `</p>` 闭合标签。  
4. 在这些标签后面**随机位置**插入占位符 `{randTOTag}`。  
5. 将每个占位符替换为**随机生成的空标签**（如 `<div id="…" class="…"></div>`、`<p>`、`<span>`）。  

最终生成的 HTML **肉眼不可见差异**，但源码中已混入随机结构噪声，可用于追踪模板复用或干扰简单爬虫。

---

## 🧪 效果示例
![效果示例](https://raw.githubusercontent.com/liumingdada/SEO_HTML_Obfuscator/refs/heads/main/show.jpg "处理前后对比")


🔧 自定义配置
 
变量 / 函数	用途说明

$templateFolder	模板目录路径，默认 ./muban。

$tags（generateRandomTagContent() 内）	要插入的随机标签列表，如 ["div", "p", "span"]。

generateRandomString()	控制生成 id / class 的字符集与长度。

getNewHTML()	如需支持更多闭合标签（如 </section>、<img> 等），可在此处扩展。


## ✅ 思路交流
VX: liumingdada 
