SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `blog`.`blog_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`blog_user` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '用户ID（唯一识别号）' ,
  `username` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户名' ,
  `password` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '密码' ,
  `email` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '用户邮箱' ,
  `create_time` TIMESTAMP NOT NULL DEFAULT '' COMMENT '创建账户时间' ,
  `logintime` TIMESTAMP NOT NULL DEFAULT '' COMMENT '最近一次登录时间（时间戳）' ,
  `loginip` VARCHAR(15) NOT NULL DEFAULT '' COMMENT '最近登录的IP地址' ,
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '启用状态：0:表示禁用；1:表示启用' ,
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '备注信息' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB
COMMENT = '用户表';


-- -----------------------------------------------------
-- Table `blog`.`blog_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`blog_role` (
  `role_id` INT NOT NULL AUTO_INCREMENT COMMENT '角色ID' ,
  `name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '角色名称' ,
  `pid` TINYINT(6) NOT NULL DEFAULT 0 COMMENT '父角色对应ID' ,
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '启用状态：0:表示禁用；1:表示启用' ,
  `remark` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '备注信息' ,
  PRIMARY KEY (`role_id`) )
ENGINE = InnoDB
COMMENT = '角色表';


-- -----------------------------------------------------
-- Table `blog`.`blog_node`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`blog_node` (
  `node_id` INT NOT NULL AUTO_INCREMENT COMMENT '节点ID' ,
  `name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '节点名称（英文名，对应应用控制器、应用、方法名）' ,
  `title` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '节点中文名' ,
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '启用状态' ,
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '备注信息' ,
  `sort` SMALLINT(6) NOT NULL DEFAULT 50 COMMENT '排序值（默认值为50）' ,
  `pid` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT '父节点ID（如:方法pid对应相应的控制器）' ,
  `level` TINYINT(1) NOT NULL DEFAULT '' COMMENT '节点类型：1:表示应用（模块）；2:表示控制器；3：表示方法' ,
  PRIMARY KEY (`node_id`) )
ENGINE = InnoDB
COMMENT = '节点表';


-- -----------------------------------------------------
-- Table `blog`.`blog_role_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`blog_role_user` (
  `user_id` INT NOT NULL DEFAULT '' ,
  `role_id` SMALLINT(6) NOT NULL DEFAULT '' ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `group_id` (`role_id` ASC) ,
  CONSTRAINT `fk_blog_role_user_blog_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `blog`.`blog_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blog_role_user_blog_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `blog`.`blog_role` (`role_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '用户角色关联表';


-- -----------------------------------------------------
-- Table `blog`.`blog_access`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`blog_access` (
  `role_id` SMALLINT(6) NOT NULL DEFAULT '' COMMENT '角色ID' ,
  `node_id` SMALLINT(6) NOT NULL DEFAULT '' COMMENT '节点ID' ,
  `level` TINYINT(1) NOT NULL DEFAULT '' ,
  `module` VARCHAR(45) NOT NULL DEFAULT '' ,
  INDEX `grounp_id` (`role_id` ASC) ,
  INDEX `node_id` (`node_id` ASC) ,
  CONSTRAINT `fk_blog_access_blog_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `blog`.`blog_role` (`role_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blog_access_blog_node1`
    FOREIGN KEY (`node_id` )
    REFERENCES `blog`.`blog_node` (`node_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '权限表';

USE `blog` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
